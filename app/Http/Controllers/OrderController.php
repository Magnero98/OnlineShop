<?php

namespace Garnet\Http\Controllers;

use Garnet\Order;
use Garnet\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Garnet\Http\Controllers\Traits\Deletion;

class OrderController extends Controller
{
    use Deletion;

    public function __construct()
    {
        $this->middleware('isUserOrder')
            ->only(['show']);
    }

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
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        }
        else if(roles('User'))
        {
            $userId = Auth::user()->id;
            $orders = Order::where('user_id', 'LIKE', $userId)
                ->orderBy('created_at', 'DESC')
                ->paginate(5);
        }

        return view('orders.index')
            ->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect(route('user::orders.store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $user = Auth::user();
        $products = $user->products;

        $order = new Order();
        $order->user_id = $user->id;
        $order->status = 'Pending';
        $order->save();

        foreach ($products as $element)
            if($element->stock < $element->pivot->quantity)
                return "Product: " . $element->name . "Does not Have Enough Item Stock";

        foreach ($products as $element)
        {
            $order->products()->attach(
                $element->id,
                ['quantity' => $element->pivot->quantity]);

            $product = Product::find($element->id);
            $product->stock -= $element->pivot->quantity;
            $product->save();
        }

        return redirect(route('user::carts.clear'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Garnet\Order  $order
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
     * @param  \Garnet\Order  $order
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
     * @param  \Garnet\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteOrder($id);

        return redirect(route('orders.index'));
    }
}
