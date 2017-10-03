@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table  table-responsive">
                <thead>
                <tr>
                    <th>
                        Design Name
                    </th>
                    @foreach ($styles as $style)
                        <th>{{$style->style}}</th>
                    @endforeach
                    <th>
                        action
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->design}}</td>
                        @foreach ($styles as $style)
                            <td>{{$style->style}}</td>
                        @endforeach
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
                    @foreach ($styles as $style)
                        <th>{{$style->style}}</th>
                    @endforeach
                    <th>
                        action
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>

                    <td><input name="design" type="text"/></td>
                    @foreach ($styles as $index => $style)
                        <td><input name="price[{{$style->id}}]" type="text"></td>
                    @endforeach
                    <td>
                        <input type="submit" value="submit">
                    </td>
                </tr>
                </tbody>
            </table>
            </form>
        </div>


        <div>
            @foreach ($styles as $style)
                <div>{{$style->style}}</div>
            @endforeach
            <form action="{{route('styles.store')}}" method="post">
                {{csrf_field()}}
                <label>style <input name="style" type="text" placeholder="style"></label>
                <input type="submit" value="submit">
            </form>
        </div>


    </div>
@endsection