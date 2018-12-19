@extends('layouts.app')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-4">
            <a class="btn btn-default pull-right" href="{{route('products.index')}}">Back</a>
        </div>
        <div class="col-md-4">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <img class="img-responsive" src="{{asset('storage/images/item-bag.svg')}}">
                </div>
                <div class="panel-body">
                    <form action="{{route('admin::products.store')}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <label class="text-primary">Product Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Product Price</label>
                            <input class="form-control" type="text" name="price">
                        </div>
                        <div class="form-group">
                            <label class="text-primary">Product Stock</label>
                            <input class="form-control" type="text" name="stock">
                        </div>
                        <input class="btn btn-primary btn-block" type="submit" value="Create Product">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection