@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            {{$quote->id}}
            <div class="table-responsive">
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
                        <th>area</th>
                        <th>amount</th>
                        @if ($quote->customer_confirmed == false)
                            <th>action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    <?php $sum = 0; ?>
                    <?php $check = false; ?>
                    @foreach ($quote_products as $product)
                        <?php
                            $check = true;
                            if ($quote->customer_confirmed == true) {
                                if ($product->pivot->price === 0) {
                                    $check = false;
                                }
                            } else {
                                if ($product['price_' . $product->pivot->style_id] === 0) {
                                    $check = false;
                                }
                            }
                        ?>
                        <tr>
                            <td>{{$product->design}}</td>
                            <td>{{$product->pivot->quantity}}</td>
                            @if ($quote->customer_confirmed == true)
                                <td>{{number_format($product->pivot->price, 2)}}</td>
                            @else
                                <td>{{number_format($product['price_'. $product->pivot->style_id], 2)}}</td>
                            @endif
                            <td>{{$style[$product->pivot->style_id]}}</td>
                            <td>{{$product->pivot->width}}</td>
                            <td>{{$product->pivot->height}}</td>
                            <td>{{$product->pivot->lite}}</td>
                            <td>
                                <?php $unit_area = total_area($product->pivot->width, $product->pivot->height) ?>
                                {{$unit_area * $product->pivot->quantity}}
                            </td>
                            <td>
                                @if ($quote->customer_confirmed == true)
                                    <?php $amount = ($unit_area * $product->pivot->price + $product->pivot->lite * 8) * $product->pivot->quantity; ?>
                                    {{number_format($amount, 2)}}
                                @else
                                    <?php $amount = ($unit_area * $product['price_' . $product->pivot->style_id] + $product->pivot->lite * 8) * $product->pivot->quantity; ?>
                                    {{number_format($amount, 2)}}
                                @endif
                            </td>
                            @if ($quote->customer_confirmed == false)
                                <td>

                                    <form action="{{route('quotes.remove_product_from_quote', ['id' => $quote->id])}}"
                                          method="post">
                                        {{csrf_field()}}
                                        {{method_field('DELETE')}}
                                        <input type="submit" value="remove"/>
                                        <input type="hidden" value="{{$product->pivot->id}}" name="pq_id">
                                    </form>

                                </td>
                            @endif
                        </tr>
                        <?php $sum += $amount ?>
                    @endforeach
                        <tr>
                            <td colspan="8"></td>
                            <td colspan="2">{{number_format($sum, 2)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @if ($quote->customer_confirmed == false)
                <form action="{{route('quotes.add_product', ['id' => $quote->id])}}" method="POST">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="design">Design</label>
                        <select name="design" id="design" class="form-control" data-live-search="true">
                            <option value="" selected disabled hidden>Choose here</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="style">Style</label>
                        <select name="style" id="style" class="form-control">
                            <option value="" selected disabled hidden>Choose here</option>
                        </select>
                    </div>
                    <input type="text" name="quantity" placeholder="quantity" value="1"/>
                    <super-input value="" name="width" placeholder="width"></super-input>
                    <super-input value="" name="height" placeholder="height"></super-input>
                    <input type="text" name="lite" placeholder="lite" value="0"/>
                    <input class="btn btn-success" type="submit" value="add"/>
                </form>
            @endif

            @if ($check)
            <form action="{{route('quotes.print_quotation', ['id' => $quote->id])}}" method="POST">
                {{csrf_field()}}
                <input type="submit" value="print quotation" class="btn btn-primary"/>
            </form>
            @endif

            @if (Auth::user()->permission < 3 && $quote->customer_confirmed == false)
                <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="client confirm" class="btn btn-success"/>
                </form>
            @endif

            @if ($quote->customer_confirmed == true && $quote->staff_confirmed == false)
                <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="withdraw quote" class="btn btn-danger"/>
                </form>
            @endif

            @if ($quote->staff_confirmed == false && $quote->customer_confirmed == true && Auth::user()->permission >= 3)
                <form action="{{route('quotes.production_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="production confirm" class="btn btn-success"/>
                </form>
            @endif
            @if ($quote->staff_confirmed == true && $quote->customer_confirmed == true && Auth::user()->permission >= 3)

                <form action="{{route('quotes.print_invoice', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="print invoice" class="btn btn-primary"/>
                </form>
            @endif
            @if ($quote->staff_confirmed == true && $quote->customer_confirmed == true)
                <form action="{{route('quotes.print_production', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="print production" class="btn btn-primary"/>
                </form>
            @endif
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script>
        window._products = @json($products);
        var ww = @json($style);

        $.each(window._products, function (index, key) {
            $('#design').append($('<option></option>', {'data-tokens': key.design}).val(key.id).data('idx', index).text(key.design))
        });

        $('#design').change(function (e) {
            $('#style').val = ''
            $('#style').empty()
            $('#style').append('<option value="" selected disabled hidden>Choose here</option>')
            var index = parseInt($("#design").find(":selected").data('idx'), 10)
            for (var i = 0; i !== 6; i++) {
                var price = parseFloat(window._products[index]['price_' + i]);
                if (!isNaN(price) && (price !== 0)) {

                    $('#style').append($('<option></option>').data('price', price).val(i).text(ww[i]))
                }
            }
        })
        $("#style").change(function (e) {
            console.log($("#style").find(":selected").data('price'))
        })
    </script>
@endsection