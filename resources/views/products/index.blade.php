@extends('layouts.app')

@section('content')
    <div class="container">
        @roles('Administrator')
            <a href="{{route('admin::products.create')}}" class="btn btn-primary">Create Product</a>
        @endroles

        @roles('User')
            <h3>Hello User</h3>
        @endroles

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