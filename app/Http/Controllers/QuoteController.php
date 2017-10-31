<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Quote;
use App\QuoteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;


class QuoteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (Auth::user()->permission >= 3) {
            $quotes = Quote::where('customer_confirmed', true)->orWhere('user_id', Auth::user()->id)->paginate(10);
        } else {
            $quotes = Auth::user()->quotes()->paginate(10);
        }
        return view('Quote.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $quote = new Quote;
        Auth::user()->quotes()->save($quote);
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $quote = Quote::findOrFail($id);
        $this->authorize('view', $quote);
        $products = Product::all();
        if (Auth::user()->permission >= 3) {
            $customers = Customer::all();
        }
        $quote_products = $quote->products;
        $styles = $this->styles;
        return view('quote.edit', compact('quote', 'quote_products', 'products', 'styles', 'customers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
        // able to change user id if you are a staff or admin
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    public function change_company(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);

        if ($quote->customer_confirmed == false) {
            $quote->customer_id = $request->company;
            $quote->save();
            $request->session()->flash('status', 'success');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function add_product_to_quote(Request $request, $id)
    {

        $quote = Quote::findOrFail($id);
        if ($quote->customer_confirmed == false) {
            $quote->products()->attach($request->design, array(
                'style_id' => $request->style,
                'quantity' => $request->quantity,
                'width' => (isset($request->width)) ? $request->width : 0,
                'height' => (isset($request->height)) ? $request->height : 0,
                'lite' => (isset($request->lite)) ? $request->lite : 0
            ));
            $request->session()->flash('status', 'success');
        } else {
            $request->session()->flash('status', 'unable to add');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function add_products_to_quote(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $designs = array();
        if ($quote->customer_confirmed == false) {
            foreach($request->designs as $design) {
                array_push($designs, $design);
            }
        }
        
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function remove_product_from_quote(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        if ($quote->customer_confirmed == false) {
            QuoteProduct::destroy($request->pq_id);
            $request->session()->flash('status', 'remove product from quotation');
        } else {
            $request->session()->flash('status', 'unable to remove, the quotation has been confirmed');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function change_profile_size(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        if ($quote->customer_confirmed == false && isset($request->size)) {
            $quote->profile_size = $request->size;
            $quote->save();
            $request->session()->flash('status', 'update profile successful');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function client_confirm($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->customer_confirmed = true;
        $products = $quote->products;
        foreach ($products as $product) {
            $quote->products()->updateExistingPivot($product->id, ['price' => $product['price_' . $product->pivot->style_id]]);
        }
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function client_confirm_withdraw($id)
    {

        $quote = Quote::findOrFail($id);
        $quote->customer_confirmed = false;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function production_confirm_withdraw($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->staff_confirmed = false;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function print_quotation($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $sum = 0;
        $sum_sqf = 0;
        $products = array();
        foreach($quote->products as $product) {
            $unit_area = total_area($product->pivot->width, $product->pivot->height);
            if ($quote->customer_confirmed == true) {
                $unit_price = ($unit_area * $product->pivot->price + $product->pivot->lite * 8);
            } else {
                $unit_price = ($unit_area * $product['price_' . $product->pivot->style_id] + $product->pivot->lite * 8);
            }
            $amount = $unit_price * $product->pivot->quantity;
            $product->total_area = $unit_area * $product->pivot->quantity;
            $product->unit_price = $unit_price;
            $product->amount = $amount;
            array_push($products, $product);
            $sum += $amount;
            $sum_sqf += $unit_area * $product->pivot->quantity;
        }
        $sum = round($sum, 2);
        $pdf = PDF::loadView('pdf.quotation', compact('quote', 'sum', 'products', '$sum_sqf'));
        return $pdf->stream('quotation_' . $id . '.pdf');
    }

    public function print_invoice($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $sum = 0;
        $sum_sqf = 0;
        $products = array();
        foreach($quote->products as $product) {
            $unit_area = total_area($product->pivot->width, $product->pivot->height);
            if ($quote->customer_confirmed == true) {
                $unit_price = ($unit_area * $product->pivot->price + $product->pivot->lite * 8);
            } else {
                $unit_price = ($unit_area * $product['price_' . $product->pivot->style_id] + $product->pivot->lite * 8);
            }
            $amount = $unit_price * $product->pivot->quantity;
            $product->total_area = $unit_area * $product->pivot->quantity;
            $product->unit_price = $unit_price;
            $product->amount = $amount;
            array_push($products, $product);
            $sum += $amount;
            $sum_sqf += $unit_area * $product->pivot->quantity;
        }
        $sum = round($sum, 2);
        $pdf = PDF::loadView('pdf.invoice', compact('quote', 'sum', 'products', '$sum_sqf'));
        return $pdf->download('invoice_' . $id . '.pdf');
    }
    
    public function print_production($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $products = $quote->products->sortByDesc(function($product, $key) {
            return parse_number($product['pivot']['height']);
        });
//        usort($products, array($this, 'cmp'));
        $pdf = PDF::loadView('pdf.production', compact('quote', 'products'));
        return $pdf->stream('product_' . $id . '.pdf');
    }

    public function production_confirm($id)
    {
        $quote = Quote::find($id);
        $quote->staff_confirmed = true;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

}
