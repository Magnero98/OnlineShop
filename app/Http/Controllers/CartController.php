<?php

namespace Garnet\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Garnet\Http\Controllers\Traits\Deletion;

class CartController extends Controller
{
    use Deletion;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $carts = $user->products;
        $totalPrice = 0;

        foreach ($carts as $cart)
            $totalPrice += $cart->price * $cart->pivot->quantity;

        return view('carts.index')
            ->with('carts', $carts)
            ->with('totalPrice', $totalPrice);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $productId = $request->productId;

        $product = $user->products->where('id', 'LIKE', $productId)->first();

        if($product == null)
            $user->products()->attach($productId,['quantity' => 1]);

        return redirect(route('home'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Garnet\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productId)
    {
        $user = Auth::user();
        $cart = $user->products->where('id', 'LIKE', $productId)->first();
        $cart->pivot->quantity = $request->quantity;
        $cart->pivot->save();

        return redirect(route('user::carts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Garnet\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId)
    {
        $user = Auth::user();
        $cart = $user->products->where('id', 'LIKE', $productId)->first();
        $cart->pivot->delete();

        return redirect(route('user::carts.index'));
    }

    public function clear()
    {
        $this->deleteCart();

        return redirect(route('orders.index'));
    }
}
