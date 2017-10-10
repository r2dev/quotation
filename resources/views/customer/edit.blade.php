@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">

            <form action="{{route('customers.update', ['id' => $customer->id])}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="PUT">
                <label>name <input name="name" type="text" value="{{$customer->name}}"/></label>
                <label>discount <input name="discount" type="text" value="{{$customer->discount}}"></label>
                <label>address <input name="address" type="text" value="{{$customer->address}}"></label>
                <label>telephone <input name="telephone" type="text" value="{{$customer->telephone}}"></label>
                <label>fax <input name="fax" type="text" value="{{$customer->fax}}"></label>
                <label>email <input name="email" type="text" value="{{$customer->email}}"></label>
                <input type="submit" value="submit">
            </form>

            Link user
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

            <form class="form-horizontal" method="POST" action="{{route('customers.add_user', ['id' => $customer->id])}}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

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
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
@endsection