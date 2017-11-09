@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>client confirmed</td>
                            <td>staff confirmed</td>
                            <td>updated at</td>
                            {{--<td>action</td>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quotes as $quote)
                            <tr class="clickable{{($quote->customer_confirmed && $quote->staff_confirmed)? ' success': ''}}" data-href="{{route('quotes.edit', [ 'id' => $quote->id])}}">
                                <td>
                                    <a href="{{route('quotes.edit', [ 'id' => $quote->id])}}">{{$quote->id}}</a>
                                </td>
                                <td>
                                    @if($quote->customer_confirmed)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="customer confirmed"></span>
                                    @endif

                                </td>
                                <td>
                                    @if($quote->staff_confirmed)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="staff confirmed"></span>
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
                    <input class="btn btn-primary" value="create quote" type="submit">
                </form>

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        jQuery(document).ready(function ($) {
            $(".clickable").click(function () {
                window.location = $(this).data("href");
            });
        });
    </script>
@endsection

