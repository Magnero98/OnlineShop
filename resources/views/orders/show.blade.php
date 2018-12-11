@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="/orders">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-success">Order Id : {{$order->id}}</li>
                        <li class="list-group-item">User : {{$order->user->name}}</li>
                        <li class="list-group-item">Order Date : {{$order->created_at}}</li>
                        @if($order->status == 'pending')
                            <li class="list-group-item"><button class="btn btn-warning btn-block">{{$order->status}}</button></li>
                        @elseif($order->status == 'process')
                            <li class="list-group-item"><button class="btn btn-info btn-block">{{$order->status}}</button></li>
                        @elseif($order->status == 'delivered')
                            <li class="list-group-item"><button class="btn btn-default btn-block">{{$order->status}}</button></li>
                        @endif
                    </ul>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->name}}</td>
                                <td>{{$product->pivot->quantity}} unit(s)</td>
                                <td>IDR {{$product->price}},00</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Price</th>
                                <th>IDR {{$totalPrice}},00</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            @roles('Administrator')
                <form action="{{route('orders.update', ['id' => $order->id])}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PUT">
                    @if($order->status == 'pending')
                        <input type="hidden" name="status" value="process">
                        <input class="btn btn-primary" type="submit" value="Process Order">
                    @elseif($order->status == 'process')
                        <input type="hidden" name="status" value="delivered">
                        <input class="btn btn-primary" type="submit" value="Deliver Order">
                    @endif
                </form>
            @endroles
            @roles('User')
                <form action="{{route('user::orders.destroy', ['id' => $order->id])}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger" type="submit" value="Delete">
                </form>
            @endroles
        </div>
    </div>
@endsection