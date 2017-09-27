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
                            <td>{{$product->pivot->price}}</td>
                            <td>{{$product->pivot->style}}</td>
                            <td>{{$product->pivot->width}}</td>
                            <td>{{$product->pivot->height}}</td>
                            <td>{{$product->pivot->lite}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


            <form action="{{route('quotes.print_quotation', ['id' => $quote->id])}}" method="POST">
                {{csrf_field()}}
                <input type="submit" value="print quotation" />
            </form>
            <form action="{{route('quotes.client_confirm', ['id' => $quote->id])}}" method="post">
                {{csrf_field()}}
                <input type="submit" value="client confirm" />
            </form>
            <form action="{{route('quotes.production_confirm', ['id' => $quote->id])}}" method="post">
                {{csrf_field()}}
                <input type="submit" value="production confirm" />
            </form>
        </div>
    </div>

@endsection

