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
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($quote_products as $product)
                        <tr>
                            <td>{{$product->design}}</td>
                            <td>{{$product->pivot->quantity}}</td>
                            @if ($quote->customer_confirmed)
                                <td>{{$product->pivot->price}}</td>
                            @else
                                <td>{{$product->mr}}</td>
                            @endif
                            <td>{{$product->pivot->style}}</td>
                            <td>{{$product->pivot->width}}</td>
                            <td>{{$product->pivot->height}}</td>
                            <td>{{$product->pivot->lite}}</td>
                            <td>
                                @if ($quote->customer_confirmed)
                                    <form action="{{route('quotes.remove_product_from_quote', ['id' => $quote->id])}}"
                                          method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type="submit" value="remove"/>
                                        <input type="hidden" value="{{$product->pivot->id}}" name="pq_id">
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @if ($quote->customer_confirmed == false)
                <form action="{{route('quotes.add_product', ['id' => $quote->id])}}" method="POST">
                    {{csrf_field()}}
                    <select name="design" id="design">
                        <option value="" selected disabled hidden>Choose here</option>

                    </select>
                    <select name="style" id="style">
                        <option value="" selected disabled hidden>Choose here</option>
                    </select>
                    <input type="text" name="quantity" placeholder="quantity" value="1"/>
                    <input type="text" name="width" placeholder="width"/>
                    <input type="text" name="height" placeholder="height"/>
                    <input type="text" name="lite" placeholder="lite"/>
                    <span>Unit price</span>
                    <div id="price"> -</div>
                    <span>Total Price</span>
                    <div id="total"> -</div>
                    <input type="submit" value="add"/>
                </form>
            @endif


            <form action="{{route('quotes.print_quotation', ['id' => $quote->id])}}" method="POST">
                {{csrf_field()}}
                <input type="submit" value="print quotation"/>
            </form>

            @if (Auth::user()->permission < 3 && $quote->customer_confirmed == false)
                <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="client confirm"/>
                </form>
            @endif

            @if ($quote->customer_confirmed == true && $quote->staff_confirmed == false)
                <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="withdraw quote"/>
                </form>
            @endif

            @if ($quote->staff_confirmed == false && Auth::user()->permission >= 3)
                <form action="{{route('quotes.production_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="production confirm"/>
                </form>
            @endif
            @if ($quote->staff_confirmed == true && Auth::user()->permission >= 3)
                <form action="{{route('quotes.production_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="print production"/>
                </form>
                <form action="{{route('quotes.production_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="print invoice"/>
                </form>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script>
        window._products = {!! $products_json !!};
        window._styles = {!! $style !!};
        window._styles_format = {}
        $.map(window._styles, function (value) {
            window._styles_format[value.id] = value
        })
        var priceHandler = function () {
            var design = parseInt($('#design').find(":selected").data('idx'), 10)
            var style = parseInt($('#style').val())
            if (isNaN(design) || isNaN(style)) {
                $('#price').text(' - ')
            } else {
                var result;
                switch (style) {
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
        $.each(window._products, function (index, key) {
            $('#design').append($('<option></option>').val(key.id).data('idx', index).text(key.design))
        });
        $('#design').change(function (e) {
            $('#style').val = ''
            $('#style').empty()
            $('#style').append('<option value="" selected disabled hidden>Choose here</option>')
            var index = parseInt($("#design").find(":selected").data('idx'), 10)
            $.map(window._products[index].product_styles, function (value, index) {
                var style_id = value.style_id
                if (value.price != 0) {
                    $('#style').append($('<option></option>').val(style_id).text(window._styles_format[style_id].style))
                }
            })
        })
        //        $('#design, #style').change(function(e) {
        //            priceHandler()
        //        });
    </script>
@endsection