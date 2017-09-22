@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            @foreach ($quotes as $quote)
                {{$quote->id}}
            @endforeach


        </div>
        <form action="{{route('quotes.store')}}" method="post">
            {{csrf_field()}}
            <input value="create quote" type="submit" >
        </form>

    </div>
@endsection