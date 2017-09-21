@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>
                        Design Name
                    </th>
                    <th>
                        Maple Select
                    </th>
                    <th>
                        Maple Regular
                    </th>
                    <th>
                        Maple Paint
                    </th>
                    <th>
                        Maple MDF
                    </th>
                    <th>
                        Oak Regular
                    </th>
                    <th>
                        Maple Regular MDF
                    </th>
                    <th>
                        Cherry Regular
                    </th>
                    <th>
                        action
                    </th>
                </tr>
                </thead>
                <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->design}}</td>
                    <td>{{$product->ms}}</td>
                    <td>{{$product->mr}}</td>
                    <td>{{$product->mp}}</td>
                    <td>{{$product->mmdf}}</td>
                    <td>{{$product->or}}</td>
                    <td>{{$product->mrmdf}}</td>
                    <td>{{$product->cr}}</td>
                    <td>
                        <form action="{{route('products.destroy', ['id' => $product->id])}}" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" value="delete" />
                        </form>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
            {!! $products->render() !!}
        </div>

        <form action="{{route('products.index')}}" method="post">
            {{ csrf_field() }}
            <label>design <input name="design" type="text"/></label>
            <label>ms <input name="ms" type="text"/></label>
            <label>mr <input name="mr" type="text"/></label>
            <label>mp <input name="mp" type="text"/></label>
            <label>mmdf <input name="mmdf" type="text"/></label>
            <label>or <input name="or" type="text"/></label>
            <label>mrmdf <input name="mrmdf" type="text"/></label>
            <label>cr <input name="cr" type="text"/></label>
            <input type="submit" value="submit">
        </form>
    </div>
@endsection