<div class="col-sm-2">
        <div class="panel panel-info">
            <div class="panel-heading" role="product-image">
                    <img class="img-responsive" src="{{asset('storage/images/garnet-shop.png')}}">
            </div>
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
</div>