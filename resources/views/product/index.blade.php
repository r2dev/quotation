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
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->design}}</td>
                            <td>{{number_format($product->price_0, 2)}}</td>
                            <td>{{number_format($product->price_1, 2)}}</td>
                            <td>{{number_format($product->price_2, 2)}}</td>
                            <td>{{number_format($product->price_3, 2)}}</td>
                            <td>{{number_format($product->price_4, 2)}}</td>
                            <td>{{number_format($product->price_5, 2)}}</td>
                            <td>{{number_format($product->price_6, 2)}}</td>
                            @if (Auth::user()->permission >= 3)

                                <td>
                                    <form action="{{route('products.destroy', ['id' => $product->id])}}" method="POST">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" value="delete"/>
                                    </form>
                                </td>
                            @endif
                        </tr>
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