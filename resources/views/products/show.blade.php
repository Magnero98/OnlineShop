@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="/products">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <img class="img-responsive" src="{{asset('storage/images/garnet-shop.png')}}">
                </div>
                <div class="panel-body">
                    <p class="lead text-center text-primary">{{$product->name}}</p>
                    Price : IDR {{$product->price}},00
                    <br>
                    Stock : {{$product->stock}} unit(s)
                </div>
            </div>
            @roles('Administrator')
                <a class="btn btn-info pull-left" href="/products/{{$product->id}}/edit">Update</a>
                <form action="{{route('admin::products.destroy', ['id' => $product->id])}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="DELETE">
                    <input class="btn btn-danger pull-right" type="submit" value="Delete">
                </form>
            @endroles
        </div>
    </div>
@endsection