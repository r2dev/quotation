@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="table-responsive">
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
                        @if (Auth::user()->permission >= 3)
                            <th>
                                action
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $index => $product)
                    @if (Auth::user()->permission >= 3)
                            <!--<tr is="changeable-row"
                            :product="{{$product}}"
                            del="{{route('products.destroy', ['id' => $product->id])}}"
                            token="{{csrf_token()}}"
                            update_url="{{route('products.update', ['id' => $product->id])}}"
                        >

                        </tr>!-->
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
                    @else
                        <td>{{$product->design}}</td>
                        <td>{{$product->price_0}}</td>
                        <td>{{$product->price_1}}</td>
                        <td>{{$product->price_2}}</td>
                        <td>{{$product->price_3}}</td>
                        <td>{{$product->price_4}}</td>
                        <td>{{$product->price_5}}</td>
                        <td>{{$product->price_6}}</td>
                    @endif
                    @endforeach

                    </tbody>
                </table>
            </div>
            {!! $products->appends(['limit' => $limit])->links() !!}
            <div class="row">
                <div class="col-sm-12 col">
                    @if (Auth::user()->permission >= 3)
                        <form action="{{route('products.store')}}" method="POST">

                            <div class="form-group">
                                <label for="design_name">Design Name</label>
                                <input type="text" name="design" id="design_name" class="form-control">
                                {{csrf_field()}}
                            </div>
                            <div class="form-group">
                                <label for="maple_select">Maple Select</label>
                                <input type="text" name="price[0]" id="maple_select" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="maple_regular">Maple Regular</label>
                                <input type="text" name="price[1]" id="maple_regular" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="maple_paint">Maple Paint</label>
                                <input type="text" name="price[2]" id="maple_paint" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="maple_mdf">Maple MDF</label>
                                <input type="text" name="price[3]" id="maple_mdf" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="oak_regular">Oak Regular</label>
                                <input type="text" name="price[4]" id="oak_regular" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="maple_regular_mdf">Maple Regular MDF</label>
                                <input type="text" name="price[5]" id="maple_regular_mdf" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="cherry_regular">Cherry Regular</label>
                                <input type="text" name="price[6]" id="cherry_regular" class="form-control">
                            </div>
                            <button class="btn btn-default">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection