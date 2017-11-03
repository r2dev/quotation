@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row">
            {{$quote->id}}
            @if ($quote->customer_confirmed == false && Auth::user()->permission >= 3)
                <form action="{{route('quotes.change_company', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <select name="company">
                        <option value="" selected disabled hidden>Choose here</option>
                        @foreach ($customers as $customer)
                            @if ($quote->customer_id == $customer->id)
                                <option value="{{$customer->id}}" selected>{{$customer->name}} </option>
                            @else
                                <option value="{{$customer->id}}">{{$customer->name}} </option>
                            @endif
                        @endforeach
                    </select>
                    <input type="submit" value="change"/>
                </form>
            @endif
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
                    <?php $undefined = false; ?>
                    @foreach ($quote_products as $product)
                        <tr>
                            <td>{{$product->design}}</td>
                            <td>{{$product->pivot->quantity}}</td>
                            @if ($quote->customer_confirmed == true)
                                @if ($product->pivot->price != 0)
                                    <td>{{number_format($product->pivot->price, 2)}}</td>
                                @else
                                    <?php $undefined = true ?>
                                    @if (Auth::user()->permission >= 3)
                                        <td>
                                            <form action="{{route('quotes.update_price', ['id' => $quote->id, 'product_id' => $product->id, 'style_id' => $product->pivot->style_id])}}"
                                                  method="post">
                                                {{csrf_field()}}
                                                <input type="text" name="value"/>
                                                <input type="submit" value="update"/>
                                            </form>
                                        </td>
                                    @else
                                        <td>undefined</td>
                                    @endif
                                @endif
                            @else
                                @if ($product['price_'. $product->pivot->style_id] != 0)
                                    <td>{{number_format($product['price_'. $product->pivot->style_id], 2)}}</td>
                                @elseif ($product->pivot->price != 0)
                                    <td>{{number_format($product->pivot->price, 2)}}</td>
                                @else
                                    <?php $undefined = true ?>
                                    <td>undefined</td>
                                @endif
                            @endif
                            <td>{{$styles[$product->pivot->style_id]}}</td>
                            <td>{{$product->pivot->width}}</td>
                            <td>{{$product->pivot->height}}</td>
                            <td>{{$product->pivot->lite}}</td>
                            <td>
                                <?php $unit_area = total_area($product->pivot->width, $product->pivot->height) ?>
                                {{$unit_area * $product->pivot->quantity}}
                            </td>
                            <td>
                                @if ($quote->customer_confirmed == true)
                                    @if ($product->pivot->price != 0)
                                        <?php $amount = ($unit_area * $product->pivot->price + $product->pivot->lite * 8) * $product->pivot->quantity; ?>
                                        {{number_format($amount, 2)}}
                                    @else
                                        undefined
                                    @endif
                                @else
                                    @if ($product['price_'. $product->pivot->style_id] != 0)
                                        <?php $amount = ($unit_area * $product['price_' . $product->pivot->style_id] + $product->pivot->lite * 8) * $product->pivot->quantity; ?>
                                        {{number_format($amount, 2)}}
                                    @elseif ($product->pivot->price != 0)
                                        <?php $amount = ($unit_area * $product->pivot->price + $product->pivot->lite * 8) * $product->pivot->quantity; ?>
                                        {{number_format($amount, 2)}}
                                    @else
                                        undefined
                                    @endif
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
                        @if (!$undefined)
                            <?php $sum += $amount ?>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="8"></td>
                        @if (!$undefined)
                            <td colspan="2">{{number_format($sum, 2)}}</td>
                        @else
                            <td></td>
                        @endif
                    </tr>
                    </tbody>
                </table>
            </div>

            @if ($quote->customer_confirmed == false)
                <form action="{{route('quotes.add_products', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <extendable-form-table
                            :products="{{$products}}"
                            :styles='@json($styles)'
                    >
                    </extendable-form-table>
                </form>
            @endif

            @if (!$undefined)
                <form action="{{route('quotes.print_quotation', ['id' => $quote->id])}}" method="POST">
                    {{csrf_field()}}
                    <input type="submit" value="print quotation" class="btn btn-primary"/>
                </form>
            @endif

            @if ($quote->customer_confirmed == false)
                <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                    {{csrf_field()}}
                    <input type="submit" value="client confirm" class="btn btn-success"/>
                </form>
            @endif

            @if ($quote->customer_confirmed == true && $quote->staff_confirmed == false)
                <form action="{{route('quotes.client_confirm_withdraw', ['id' => $quote->id])}}" method="post">
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
