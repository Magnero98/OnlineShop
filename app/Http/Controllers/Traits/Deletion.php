<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/16/2018
 * Time: 9:20 PM
 */

namespace App\Http\Controllers\Traits;

use App\Order;
use App\User;
use App\Product;
use Illuminate\Support\Facades\Auth;

trait Deletion
{
    public function deleteUser($userId)
    {
        $this->deleteCart();

        Order::where('user_id', 'LIKE', Auth::user()->id)->delete();

        $user = User::find($userId);
        $user->delete();
    }

    public function deleteProduct($productId)
    {
        $product = Product::find($productId);
        $product->delete();
    }

    public function deleteOrder($orderId)
    {
        $order = Order::find($orderId);
        $order->delete();
    }

    public function deleteCart()
    {
        $user = Auth::user();

        foreach ($user->products as $product)
            $product->pivot->delete();
    }
}