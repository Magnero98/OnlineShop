@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>User Id</td>
                        <td>User Name</td>
                        <td>Order Status</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user_id}}</td>
                        <td>{{$order->user_id}}</td>
                        <td>{{$order->status}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
