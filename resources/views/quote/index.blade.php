@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>status</td>
                        <td>date</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                @foreach ($quotes as $quote)
                    <tr>
                        <td>
                            <a href="{{route('quotes.edit', [ 'id' => $quote->id])}}">{{$quote->id}}</a>
                        </td>
                        <td>
                            @if($quote->customer_confirmed)
                                <span>C</span>
                            @endif
                            @if($quote->staff_confirmed)
                                <span>S</span>
                                @endif
                        </td>
                        <td>
                            {{$quote->updated_at}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>


        </div>
        <form action="{{route('quotes.store')}}" method="post">
            {{csrf_field()}}
            <input value="create quote" type="submit">
        </form>

    </div>
@endsection