@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>User Id</th>
                    <th>User Name</th>
                    <th>Order Status</th>
                    <th>Show</th>
                    <th></th>
                </thead>
                <td>
                @foreach($orders as $order)
                    <tr>
                        <td>{{$order->user_id}}</td>
                        <td>{{$order->user->name}}</td>
                        @if($order->status == 'pending')
                            <td><a class="btn btn-sm btn-block btn-warning">{{$order->status}}</a></td>
                        @elseif($order->status == 'process')
                            <td><button class="btn btn-sm btn-block btn-info">{{$order->status}}</button></td>
                        @elseif($order->status == 'delivered')
                            <td><button class="btn btn-sm btn-block btn-default">{{$order->status}}</button></td>
                        @endif
                        <td><a class="btn btn-sm btn-default center-block" href="/orders/{{$order->id}}">Show Details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>
@endsection
