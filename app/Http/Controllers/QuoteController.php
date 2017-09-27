<?php

namespace App\Http\Controllers;

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
        //
//        if (Auth::user()->permission >= 3) {
//            $quotes = Quote::paginate(10);
//        } else if (Auth::user()->permission === 2) {
//
//        } else {
//            $quotes = array();
//        }
        $quotes = Auth::user()->quotes()->get();

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
        if ($quote->customer_confirmed == true) {
            return redirect(route('quotes.show', ['id' => $quote->id]));
        }
        $products = Product::all();
        $products_json = $products->toJson();
        $quote_products = $quote->products;
        return view('quote.edit', compact('quote', 'quote_products', 'products_json'));

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
        $quote->products()->attach($request->design, array('quantity' => $request->quantity, 'width' => $request->width, 'height' => $request->height, 'lite' => $request->lite));
        return redirect(route('quotes.edit', ['id' => $quote->id]));
    }

    public function client_confirm($id)
    {
        $quote = Quote::find($id);
        $quote->customer_confirmed = true;
        $quote->save();
        return redirect(route('quotes.show', ['id' => $quote->id]));
    }

    public function print_quotation($id)
    {
        $pdf = PDF::loadHTML('<h1>Test</h1>');
        return $pdf->download('quotation_' . $id . '.pdf');
    }

}
