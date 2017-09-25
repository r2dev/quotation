<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
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
        $customers = Customer::paginate(10);
        return view('customer.index', compact('customers'));
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
        $customer = new Customer;
        if (isset($request->name)) {
            $customer->name = $request->name;
        }
        $customer->save();
        return redirect('/customers');
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
        $customer = Customer::find($id);
        $users = $customer->users();
        return view('customer.edit', compact('customer', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        //
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->discount = $request->discount;
        $customer->address = $request->address;
        $customer->telephone = $request->telephone;
        $customer->email = $request->email;
        $customer->save();
        $request->session()->flash('status', 'customer update was successful');
        return redirect(route('customers.edit', ['id' => $customer->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request)
    {
        //
        $customer = Customer::find($id);
        $customer->delete();
        $request->session()->flash('status', 'customer removal was successful!');
        return redirect('/customers');
    }

}
