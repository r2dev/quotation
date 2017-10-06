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
                        <td>{{$product->price_0}}</td>
                        <td>{{$product->price_1}}</td>
                        <td>{{$product->price_2}}</td>
                        <td>{{$product->price_3}}</td>
                        <td>{{$product->price_4}}</td>
                        <td>{{$product->price_5}}</td>
                        <td>{{$product->price_6}}</td>
                        <td>
                            <form action="{{route('products.destroy', ['id' => $product->id])}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            {!! $products->render() !!}
            <form action="{{route('products.store')}}" method="POST">
                <table class="table  table-responsive">
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
                    <tr>

                        <td><input name="design" type="text">{{csrf_field()}}</td>
                        <td><input name="price[0]" type="text"></td>
                        <td><input name="price[1]" type="text"></td>
                        <td><input name="price[2]" type="text"></td>
                        <td><input name="price[3]" type="text"></td>
                        <td><input name="price[4]" type="text"></td>
                        <td><input name="price[5]" type="text"></td>
                        <td><input name="price[6]" type="text"></td>
                        <td>
                            <input type="submit" value="submit">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>


    </div>
@endsection