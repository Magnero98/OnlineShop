@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-default">
            <form id="search-form" class="panel-heading form-horizontal" action="{{route('home')}}" method="GET">
                <div class="input-group">
                    <span class="input-group-addon">Search Product</span>
                    <input id="email" type="text" class="form-control" name="keyword" placeholder="Type Something Here . . .">
                    <span class="input-group-addon" onclick="document.getElementById('search-form').submit();"><i class="fa fa-search"></i></span>
                </div>
            </form>
        </div>
        <div class="row">
            @foreach($products as $product)
                @include('shapes.product-box', [
                    'products' => $product
                ])
            @endforeach
        </div>
        {{$products->links()}}
    </div>

@endsection