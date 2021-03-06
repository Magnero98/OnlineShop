@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <form id="search-form" class="panel-heading form-horizontal" action="{{route('orders.index')}}" method="GET">
                    <div class="input-group">
                        <span class="input-group-addon">Search Order</span>
                        <input id="email" type="date" class="form-control" name="keyword" placeholder="Type Something Here . . .">
                        <span class="input-group-addon" onclick="document.getElementById('search-form').submit();"><i class="fa fa-search"></i></span>
                    </div>
                </form>
            </div>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>User Id</th>
                    <th>Image</th>
                    <th>User Name</th>
                    <th>Order Status</th>
                    <th>Show</th>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->user_id}}</td>
                            <td><img class="img-circle center-block" src="{{asset('storage/images/' . $order->user->image)}}" style="height: 45px;"></td>
                            <td>{{$order->user->name}}</td>
                            @if($order->status == 'Pending')
                                <td><a class="btn btn-block btn-warning">{{$order->status}}</a></td>
                            @elseif($order->status == 'Process')
                                <td><button class="btn btn-block btn-info">{{$order->status}}</button></td>
                            @elseif($order->status == 'Delivered')
                                <td><button class="btn btn-block btn-default">{{$order->status}}</button></td>
                            @endif
                            <td><a class="btn btn-default center-block" href="{{route('orders.show', ['id' => $order->id])}}">Show Details</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>
@endsection
