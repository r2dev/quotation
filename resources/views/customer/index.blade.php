@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Customer</div>
        <div class="panel-body">
            <div class="container-fluid">
                {{--<div class="row">--}}
                {{--<select>--}}
                {{--<option value="10" selected="{{$limit == '10'}}">10</option>--}}
                {{--<option value="30" selected="{{$limit == '30'}}">30</option>--}}
                {{--<option value="50" selected="{{$limit == '50'}}">50</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                <div class="row">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>
                                Name
                            </th>
                            <th>
                                Action
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($customers as $customer)
                            <tr class="clickable" data-href="{{route('customers.edit', ['id' => $customer->id])}}">
                                <td>
                                    <a href="{{route('customers.edit', ['id' => $customer->id])}}">{{$customer->name}}</a>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-info">Update</button>
                                    <form action="{{route('customers.destroy', ['id' => $customer->id])}}"
                                          method="POST"
                                          class="form-inline"
                                          style="display: inline-block"
                                    >
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" value="Delete" class="btn btn-danger"/>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $customers->appends(['limit' => $limit])->links() }}
                </div>
            </div>
        </div>
    </div>


    <div class="panel panel-default">
        <div class="panel-heading">Add customer</div>
        <div class="panel-body">
            <div class="container-fluid">
                <form action="{{route('customers.index')}}" method="post" class="form-inline">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control"/>
                        <input type="submit" value="submit" class="btn btn-default">
                    </div>
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