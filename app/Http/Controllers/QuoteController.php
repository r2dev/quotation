<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductStyle;
use App\Quote;
use App\QuoteProduct;
use App\Style;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //pass quote
        $quote = Quote::find($id);
        $this->authorize('view', $quote);
        $quote_products = $quote->products;
        return view('quote.show', compact('quote', 'quote_products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $quote = Quote::find($id);
        $products = Product::all();
        $quote_products = $quote->products;
        $style = array('Maple Select', 'Maple Regular', 'Maple Paint', 'Maple MDF', 'Oak Regular', 'Maple Regular MDF', 'Cherry Regular');
        return view('quote.edit', compact('quote', 'quote_products', 'products', 'style'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
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
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    }

    public function add_product_to_quote(Request $request, $id)
    {

        $quote = Quote::find($id);
        if ($quote->customer_confirmed == false) {
            $quote->products()->attach($request->design, array(
                'style_id' => $request->style,
                'quantity' => $request->quantity,
                'width' => (isset($request->width))? $request->width: 0,
                'height' => (isset($request->height))? $request->height: 0,
                'lite' => (isset($request->lite))? $request->lite: 0
            ));
            $request->session()->flash('status', 'success');
        } else {
            $request->session()->flash('status', 'unable to add');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function remove_product_from_quote(Request $request, $id)
    {
        $quote = Quote::find($id);
        if ($quote->customer_confirmed == false) {
            QuoteProduct::destroy($request->pq_id);
        } else {
            $request->session()->flash('status', 'unable to remove, the quotation has been confirmed');
        }
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function client_confirm($id)
    {
        $quote = Quote::find($id);
        $quote->customer_confirmed = true;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function print_quotation($id)
    {
        $quote = Quote::with(['user', 'user.customer'])->find($id);
        $pdf = PDF::loadView('pdf.quotation', compact('quote'));

//$quote = Quote::find($id);

//        $quote->user();
//        var_dump($quote->user->customer->name);
        return $pdf->stream('quotation_' . $id . '.pdf');
    }

    public function print_invoice($id)
    {
        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->download('invoice_' . $id . '.pdf');
    }

    public function print_production($id)
    {
        $pdf = PDF::loadView('pdf.production');
        return $pdf->download('product_' . $id . '.pdf');
    }

    public function production_confirm($id)
    {
        $quote = Quote::find($id);
        $quote->staff_confirmed = true;
        $quote->save();
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

}
