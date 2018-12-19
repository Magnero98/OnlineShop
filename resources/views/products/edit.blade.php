@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="/products">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <img class="img-responsive" src="{{asset('storage/images/item-bag.svg')}}">
                </div>
                <div class="panel-body">
                    <form action="/products/{{$product->id}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="text-primary">Product Name</label>
                            <input class="form-control" type="text" name="name" value="{{$product->name}}">
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Product Price</label>
                            <input class="form-control" type="text" name="price" value="{{$product->price}}">
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Product Stock</label>
                            <input class="form-control" type="text" name="stock" value="{{$product->stock}}">
                        </div>

                        <input type="hidden" name="_method" value="PUT">
                        <input class="btn btn-primary btn-block" type="submit" value="Update Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection