@extends('layouts.app')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Customer Information
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">

                    <form action="{{route('customers.update', ['id' => $customer->id])}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <label>name </label><input name="name" type="text" value="{{$customer->name}}"
                                                       class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>discount </label>
                            <div class="input-group">
                                <input name="discount" type="text" value="{{$customer->discount}}" class="form-control">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>cash</label>
                            <div class="input-group">
                                <input name="cash" type="text" value="{{$customer->cash}}" class="form-control">
                                <div class="input-group-addon">%</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>address</label> <input name="address" type="text" value="{{$customer->address}}"
                                                          class="form-control">
                        </div>
                        <div class="form-group">
                            <label>telephone </label><input name="telephone" type="text"
                                                            value="{{$customer->telephone}}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>fax </label><input name="fax" type="text" value="{{$customer->fax}}"
                                                      class="form-control">
                        </div>
                        <div class="form-group">
                            <label>email </label><input name="email" type="text" value="{{$customer->email}}"
                                                        class="form-control">
                        </div>
                        <input type="submit" class="btn btn-default" value="update">
                    </form>


                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Link user
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>email</th>
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$user->email}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <form class="form-horizontal" method="POST"
                          action="{{route('customers.add_user', ['id' => $customer->id])}}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                       required
                                       autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                       value="{{ old('email') }}"
                                       required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation"
                                       required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Customer Quotes
        </div>
        <div class="panel-body">
            <div class="container-fluid">
                <div class="row">
                   <table class="table">
                   <thead>
                        <tr>
                            <th>id</th>
                            <th>status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($quotes as $quote)
                            <tr class="clickable" data-href="{{route('quotes.edit', [ 'id' => $quote->id])}}">
                                <td>{{$quote->id}}</td>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
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