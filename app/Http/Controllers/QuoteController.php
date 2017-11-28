<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Product;
use App\Quote;
use App\QuoteProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
            $quotes = Quote::where('customer_confirmed', true)
                ->orWhere('user_id', Auth::user()->id)
                ->paginate(10);
        } else {
            $quotes = Auth::user()->quotes()->paginate(10);
        }
        return view('quote.index', compact('quotes'));
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
            $request->session()->flash('status', 'update company success');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function change_style(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        if ($quote->customer_confirmed == false) {
            //@todo update pivot table price and style (no test)
            DB::table('quote_product')->where('quote_id', $id)->where('style_id','<>', $request->style_id)->update(array('price' => 0, 'style_id' => $request->style_id));
            $quote->style_id = $request->style_id;
            $quote->save();
            $request->session()->flash('status', 'update material success');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function add_products_to_quote(Request $request, $id)
    {
        $quote = Quote::findOrFail($id);
        $attachResult = array();
        if ($quote->customer_confirmed == false) {
            foreach ($request->product as $index => $product) {
                $validator = Validator::make($product, [
                    'design' => 'required',
                    'style' => 'required',
                    'quantity' => 'required|min:1|numeric',
                    'width' => 'required',
                    'height' => 'required',
                    'lite' => 'required|min:0|numeric',
                ]);
                if ($validator->passes()) {
                    array_push($attachResult, array(
                        'product_id' => $product['design'],
                        'quote_id' => $id,
                        'style_id' => $product['style'],
                        'quantity' => $product['quantity'],
                        'width' => $product['width'],
                        'height' => $product['height'],
                        'lite' => $product['lite']
                    ));
                }
            }
        }
        if (count($attachResult) != 0) {
            QuoteProduct::insert($attachResult);
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function update_price(Request $request, $id, $product_id, $style_id)
    {
//        $request->validate([
//            'value' => 'required|numeric',
//
//        ]);
        $quote = Quote::findOrFail($id);
//        $quote->products()->updateExistingPivot($pid, ['price' => $request->value]);
//        $products = QuoteProduct::with('products')->where('quote_id', $id)->where('id', $pid)->get();
        if ($quote->customer_confirmed == true && $quote->staff_confirmed == false && Auth::user()->permission >= 3) {
            DB::table('quote_product')->where('quote_id', $id)->where('product_id', $product_id)->where('style_id', $style_id)->update(array('price' => $request->value));
        }
        return redirect(route('quotes.edit', ['id' => $id]));
    }

    public function update_product_profile_size(Request $request, $id)
    {
        //only permission >= 3

        DB::table('quote_product')->where('id', $request->pq_id)->update(array('adjustment' => $request->adjustment));
        return redirect(route('quotes.edit', ['id' => $id]));
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

    public function client_confirm($id)
    {
        $quote = Quote::findOrFail($id);
        $quote->customer_confirmed = true;
        $quote->confirmed_on = Carbon::now();
        $products = QuoteProduct::with('product')->where('quote_id', $id)->get();
//        $products = $quote->products;
        foreach ($products as $product) {
//            dd($product->style_id);
            if ($product->product['price_' . $product->style_id] != 0) {
                DB::table('quote_product')->where('id', $product->id)->update(array('price' => $product->product['price_' . $product->style_id]));
            }
        }
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function client_confirm_withdraw($id)
    {

        $quote = Quote::findOrFail($id);
        if ($quote->staff_confirmed === true) {
            return redirect(route('quotes.edit', ['id' => $quote->id]));
        }
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
        foreach ($quote->products as $product) {
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
        $styles = $this->styles;
        $pdf = PDF::loadView('pdf.quotation', compact('quote', 'sum', 'products', '$sum_sqf', 'styles'));
        return $pdf->stream('quotation_' . $id . '.pdf');
    }

    public function print_invoice($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $sum = 0;
        $sum_sqf = 0;
        $products = array();
        foreach ($quote->products as $product) {
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
        return $pdf->stream('invoice_' . $id . '.pdf');
    }

    public function print_production($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->findOrFail($id);
        $groups = array();
        $temp_groups = $quote->products->groupBy(function($product, $key) {
            return $product['pivot']['adjustment'];
        });
        foreach ($temp_groups as $key=>$group) {
            $groups[$key] = $group->sortByDesc(function ($product, $key) {
                if ($product->frame === 1) {
                    return 10000;
                }
                return parse_number($product['pivot']['height']);
            });
        }
        $styles = $this->styles;
        $pdf = PDF::loadView('pdf.production', compact('quote', 'groups', 'styles'));
        return $pdf->stream('product_' . $id . '.pdf');
    }

    public function production_confirm($id)
    {
        //production confirm only when customer has confirmed and the price are all set
        $quote = Quote::find($id);
        $quote->staff_confirmed = true;

        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function update_value(Request $request, $id) {

        $quote = Quote::findOrFail($id);
        $request->validate([
           'name' => ['required', Rule::in(['po', 'terms', 'panel', 'door_style', 'lip', 'moulding'])]
        ]);
        $quote[$request->name] = $request->value;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }




}
