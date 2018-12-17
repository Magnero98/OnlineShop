@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            @foreach($carts as $cart)
                <div class="well" style="padding-top: 5px">
                    <div class="row">
                        <form action="{{route('user::carts.destroy', ['cart' => $cart->id])}}" method="POST">
                            {{csrf_field()}}
                            <input class="img-responsive pull-right" type="image" src="{{asset('storage/images/remove-button.svg')}}" width="15px" height="15px" style="padding-bottom: 5px">
                            <input type="hidden" name="_method" value="DELETE">
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <img class="img-responsive" src="{{asset('storage/images/shopping-bag.svg')}}">
                        </div>
                        <div class="col-md-6">
                            <label class="text-primary">{{$cart->name}}</label>
                            <p>IDR {{$cart->price}},00</p>
                        </div>
                        <div class="col-md-4">
                            <div class="subtitle">
                                <label class="center-block text-center">Quantity</label>
                            </div>
                            <div class="body row">
                                <form action="{{route('user::carts.update', ['cart' => $cart->id])}}" method="POST">
                                    {{csrf_field()}}
                                    <div class="col-md-3" style="padding: 0">
                                        <input class="img-responsive text-center" type="number" name="quantity" min="1" max="99" value="{{$cart->pivot->quantity}}">
                                    </div>
                                    <div class="col-md-4">
                                        <label>unit(s)</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="btn btn-primary img-responsive" type="image" src="{{asset('storage/images/refresh-button.svg')}}">
                                    </div>
                                        <input type="hidden" name="_method" value="PUT">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="container-fluid position-sticky">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <label>Shopping Summary</label>
                    </div>
                    <div class="panel-body">
                        <label>Total Price : </label> IDR {{$totalPrice}},00
                    </div>
                    <div class="panel-footer">
                        <a class="btn btn-primary btn-block" href="{{route('user::orders.create')}}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection