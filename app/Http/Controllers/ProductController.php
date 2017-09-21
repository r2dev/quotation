<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
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
        $product = new Product;
        if (isset($request->design)) {
            $product->design = $request->design;
        }
        if (isset($request->ms)) {
            $product->ms = $request->ms;
        }
        if (isset($request->mr)) {
            $product->mr = $request->mr;
        }
        if (isset($request->mp)) {
            $product->mp = $request->mp;
        }
        if (isset($request->mmdf)) {
            $product->mmdf = $request->mmdf;
        }
        if (isset($request->or)) {
            $product->or = $request->or;
        }
        if (isset($request->mrmdf)) {
            $product->mrmdf = $request->mrmdf;
        }
        if (isset($request->cr)) {
            $product->cr = $request->cr;
        }
        $product->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }

}
