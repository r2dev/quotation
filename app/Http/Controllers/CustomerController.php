<?php

namespace App\Http\Controllers;

use App\Customer;
use App\User;
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
    public function index(Request $request)
    {
        //
        $limit = 20;
        if (isset($request->limit) && is_numeric($request->limit)) {
            $limit = intval($request->limit);
        }
        $customers = Customer::paginate($limit);
        return view('customer.index', compact('customers', 'limit'));
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
        return redirect(route('customers.edit', ['id' => $customer->id]));
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
        $users = $customer->users;
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

        if (isset($request->name)) {
            $customer->name = $request->name;
        }
        if (isset($request->discount)) {
            $customer->discount = $request->discount;
        }
        if (isset($request->address)) {
            $customer->address = $request->address;
        }
        if (isset($request->telephone)) {
            $customer->telephone = $request->telephone;
        }
        if (isset($request->fax)) {
            $customer->fax = $request->fax;
        }
        if (isset($request->email)) {
            $customer->email = $request->email;
        }
        if (isset($request->cash)) {
            $customer->cash = $request->cash;
        }
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

    public function create_user($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $customer = Customer::find($id);
        $customer->users()->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'customer_id' => $id
        ]);
        return redirect(route('customers.edit', ['id' => $id]));
    }

}
