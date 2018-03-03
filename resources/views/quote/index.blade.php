@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <form method="get" action="{{route('quotes.index')}}">
                    <select name="type">
                        <option value="po">po#</option>
                        <option value="invoice_id">invoce#</option>
                        <option value="order_id">order#</option>
                    </select>
                    <input name="like" type="search"/>
                    <input type="submit" value="Search"/>
                    </form>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <table class="table table-hover table-bordered">
                        <thead>
                        <tr>
                            <td>#</td>
                            <td>po</td>
                            <td>invoice#</td>
                            <td>order#</td>
                            <td>client confirmed</td>ss
                            <td>staff confirmed</td>
                            <td>Delivered</td>
                            <td>Paid</td>
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
                                    {{$quote->po}}
                                </td>
                                <td>
                                    {{$quote->invoice_id}}
                                </td>
                                <td>
                                    {{$quote->order_id}}
                                </td>
                                <td>
                                    @if($quote->customer_confirmed)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="customer confirmed"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" title="not paid"></span>
                                    @endif

                                </td>
                                <td>
                                    @if($quote->staff_confirmed)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="staff confirmed"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" title="not paid"></span>
                                    @endif
                                </td>
                                <td id="toggle-deliver" data-href="{{route('quotes.toggle_deliver', [ 'id' => $quote->id])}}">

                                    @if($quote->delivered)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="delivered"></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" title="not delivered"></span>
                                    @endif
                                </td>
                                <td id="toggle-pay" data-href="{{route('quotes.toggle_pay', [ 'id' => $quote->id])}}">
                                    @if($quote->paid)
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" title="paid" ></span>
                                    @else
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" title="not paid"></span>
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
        $(document).ready(function () {
            $(".clickable").click(function (e) {
                e.stopPropagation()
                var href = $(this).data("href")
                if (href.length > 0) {
                    window.location = href;
                }
            });
        });

        $('#toggle-deliver, #toggle-pay').click(function(e) {
            //toggle flash
            e.stopPropagation()
            var href = $(this).data('href');
            if (href.length > 0) {
                window.location = href;
            };
        });
    </script>
@endsection

