@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            <form action="{{route('customers.update', ['id' => $customer->id])}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <label>name <input name="name" type="text" value="{{$customer->name}}"/></label>
                <label>discount <input name="discount" type="number" value="{{$customer->discount}}"></label>
                <label>address <input name="discount" type="number" value="{{$customer->address}}"></label>
                <label>telephone <input name="discount" type="number" value="{{$customer->telephone}}"></label>
                <label>fax <input name="discount" type="number" value="{{$customer->fax}}"></label>
                <label>email <input name="discount" type="number" value="{{$customer->email}}"></label>
                <input type="submit" value="submit">
            </form>
        </div>
@endsection