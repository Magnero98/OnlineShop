<?php

namespace App\Http\Controllers;

use App\Order;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Debug\Tests\Fixtures\ToStringThrower;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = null;

        if(roles('Administrator'))
        {
            $orders = Order::where('id', '!=', 0)
                ->paginate(5);
        }
        else if(roles('User'))
        {
            $userId = Auth::user()->id;
            $orders = Order::where('user_id', 'LIKE', $userId)
                ->paginate(5);
        }

        return view('orders.index')
            ->with('orders', $orders);
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
        $products = $user->products;

        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 'pending';
        $order->save();

        foreach ($products as $element)
        {
            $order->products()->attach(
                $element->id,
                ['quantity' => $element->quantity]);

            $product = Product::find($element->id);
            $product->stock -= $element->quantity;
            $product->save();
        }

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $products = $order->products;
        $totalPrice = 0;

        foreach ($products as $product)
            $totalPrice += $product->price * $product->pivot->quantity;

        return view('orders.show')
            ->with('order', $order)
            ->with('products', $products)
            ->with('totalPrice', $totalPrice);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status = $request->status;
        $order->save();

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();

        return redirect(route('orders.index'));
    }
}
