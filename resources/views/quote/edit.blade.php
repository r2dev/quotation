@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">

            {{$quote->id}}
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>name</th>
                        <th>quantity</th>
                        <th>price</th>
                        <th>style</th>
                        <th>width</th>
                        <th>height</th>
                        <th>lite</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($quote_products as $product)
                        <tr>
                            <td>{{$product->design}}</td>
                            <td>{{$product->pivot->quantity}}</td>

                            <td>{{$product->mr}}</td>

                            <td>{{$product->pivot->style}}</td>
                            <td>{{$product->pivot->width}}</td>
                            <td>{{$product->pivot->height}}</td>
                            <td>{{$product->pivot->lite}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <form action="{{route('quotes.add_product', ['id' => $quote->id])}}" method="POST">
                {{csrf_field()}}
                <select name="design" id="design">
                    <option value="" selected disabled hidden>Choose here</option>
                </select>
                <select name="style" id="style">
                    <option value="" selected disabled hidden>Choose here</option>
                    <option value="0">Maple Select</option>
                    <option value="1">Maple Regular</option>
                    <option value="2">Maple Paint</option>
                    <option value="3">Maple MDF</option>
                    <option value="4">Oak Regular</option>
                    <option value="5">Maple Regular MDF</option>
                    <option value="6">Cherry Regular</option>
                </select>
                <input type="text" name="quantity" placeholder="quantity" value="1"/>
                <input type="text" name="width" placeholder="width"/>
                <input type="text" name="height" placeholder="height"/>
                <input type="text" name="lite" placeholder="lite"/>
                <span>Unit price</span><div id="price"> - </div>
                <span>Total Price</span><div id="total"> - </div>
                <input type="submit" value="add"/>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script>
        window._products = {!! $products_json !!};
        var priceHandler = function() {
            var design = parseInt($('#design').find(":selected").data('idx'), 10)
            var style = parseInt($('#style').val())
            if (isNaN(design) || isNaN(style)) {
                $('#price').text(' - ')
            } else {
                var result;
                switch(style) {
                    case 0:
                        result = window._products[design].ms;
                        break;
                    case 1:
                        result = window._products[design].mr;
                        break;
                    case 2:
                        result = window._products[design].mp;
                        break;
                    case 3:
                        result = window._products[design].mmdf;
                        break;
                    case 4:
                        result = window._products[design].or;
                        break;
                    case 5:
                        result = window._products[design].mrmdf;
                        break;
                    case 6:
                        result = window._products[design].cr;
                        break;
                }
                $('#price').text(' ' + result + ' ')
            }
        }
        $.each(window._products, function(index, key) {
            $('#design').append($('<option></option>').val(key.design).data('idx', index).text(key.design))
        });
        $('#design, #style').change(function(e) {
            priceHandler()
        });
    </script>
@endsection