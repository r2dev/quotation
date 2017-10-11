<?php

namespace App\Http\Controllers;

use App\Product;
use App\Quote;
use App\QuoteProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $quotes = Quote::where('customer_confirmed', true)->paginate(10);
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
        $quote_products = $quote->products;
        $style = array('Maple Select', 'Maple Regular', 'Maple Paint', 'Maple MDF', 'Oak Regular', 'Maple Regular MDF', 'Cherry Regular');
        return view('quote.edit', compact('quote', 'quote_products', 'products', 'style'));

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

    public function remove_product_from_quote(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        if ($quote->customer_confirmed == false) {
            QuoteProduct::destroy($request->pq_id);
        } else {
            $request->session()->flash('status', 'unable to remove, the quotation has been confirmed');
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

    public function print_quotation($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.quotation', compact('quote'));
        return $pdf->stream('quotation_' . $id . '.pdf');
    }

    public function print_invoice($id)
    {
        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->download('invoice_' . $id . '.pdf');
    }

    public function print_production($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $pdf = PDF::loadView('pdf.production', compact('quote'));
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
