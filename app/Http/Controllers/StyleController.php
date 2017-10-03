<?php

namespace App\Http\Controllers;

use App\Style;
use Illuminate\Http\Request;

class StyleController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $style = new Style;
        $style->style = $request->style;
        $style->save();
        return redirect('/products');
    }

    public function destroy($id)
    {
        $style = Style::find($id);
        $style->delete();
        return redirect('/products');
    }
}
