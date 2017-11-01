<?php

namespace App\Http\Controllers;

use App\Product;
use App\Style;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function index(Request $request)
    {
        //
        $limit = 30;
        if (isset($request->limit) && is_numeric($request->limit)) {
            $limit = intval($request->limit);
        }
        $products = Product::paginate($limit);
        $styles = $this->styles;
        return view('product.index', compact('products', 'limit', 'styles'));
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
            $price_array = $request->price;
            foreach ($price_array as $key => $price) {
                if (isset($price)) {
                    $product['price_' . $key] = $price;
                }
            }
            $product->save();
        }
        return redirect('/products');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);
        if ($request->index === -2) {
            $request->validate([
               'value'  =>  'unique:products,design'
            ]);
            $product['design'] = $request->value;
            $product->save();
            return response()->json($product['design']);
        } else if ($request->index === -3) {
            $product['rule'] = $request->value;
            $product->save();
            return response()->json($product['rule']);
        } else if ($request->index === -4) {
            $product['profile_size'] = $request->value;
            $product->save();
            return response()->json($product['profile_size']);
        } else if ($request->index >= 0) {
            $product['price_' . $request->index] = $request->value;
            $product->save();
            return response()->json($product['price_'. $request->index]);
        }

        return response()->json('failed', 500);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
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
