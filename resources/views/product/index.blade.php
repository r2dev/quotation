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
                        @foreach ($styles as $style)
                            <th>
                                {{$style}}
                            </th>
                        @endforeach
                        @if (Auth::user()->permission >= 3)
                            <th>
                                action
                            </th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $index => $product)
                        <tr>
                            @if (Auth::user()->permission >= 3)
                                    <tr is="changeable-row"
                                        :product="{{$product}}"
                                        del="{{route('products.destroy', ['id' => $product->id])}}"
                                        token="{{csrf_token()}}"
                                        update_url="{{route('products.update', ['id' => $product->id])}}"
                                        :size="{{count($styles)}}"
                                    >
                                    </tr>
                            @else
                                <td>{{$product->design}}</td>
                                @for ($i = 0; $i < count($styles); $i++)
                                    <td>{{(float)$product['price_' . $i]}}</td>
                                @endfor
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
                            @foreach ($styles as $index => $style)
                            <div class="form-group">
                                <label for="{{$style}}">{{$style}}</label>
                                <input type="text" name="price[{{$index}}]" id="{{$style}}" class="form-control">
                            </div>
                            @endforeach
                            <button class="btn btn-default">Submit</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection