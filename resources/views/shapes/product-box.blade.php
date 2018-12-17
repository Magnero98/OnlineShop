<div class="col-sm-2">
    <div class="panel panel-info">
        <div class="panel-heading" role="product-image">
            <img class="img-responsive" src="{{asset('storage/images/garnet-shop.png')}}">
        </div>
        <div class="panel-body" role="product-description">
            <a href="{{route('products.show', ['id' => $product->id])}}">
                <div class="panel-body" role="product-details">
                    <p class="text-center">
                        <span class="text-primary">{{$product->name}}</span>
                    </p>
                    <p class="text-center">
                        <span class="text">IDR {{$product->price}},00</span>
                    </p>
                </div>
            </a>
        </div>
        @roles('User')
            <div class="panel-footer" role="add-to-cart-btn">
                <form action="{{route('user::carts.store')}}" method="POST">
                    {{csrf_field()}}
                    <input type="hidden" name="productId" value="{{$product->id}}">
                    <input class="btn btn-primary btn-block" type="image" src="{{asset('storage/images/add-to-cart-button.svg')}}" style="height: 35px">
                </form>
            </div>
        @endroles
    </div>
</div>