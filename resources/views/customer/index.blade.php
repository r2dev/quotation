@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>
                         Name
                    </th>

                </tr>
                </thead>
                <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>
                            <a href="{{route('customers.edit', ['id' => $customer->id])}}">{{$customer->name}}</a>
                        </td>

                        <td>
                            <form action="{{route('customers.destroy', ['id' => $customer->id])}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" value="delete" />
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $customers->render() !!}
        </div>

        <form action="{{route('customers.index')}}" method="post">
            {{ csrf_field() }}
            <label>name<input name="name" type="text"/></label>
            <input type="submit" value="submit">
        </form>
    </div>
@endsection