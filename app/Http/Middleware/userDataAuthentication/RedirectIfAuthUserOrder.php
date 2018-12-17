<?php

namespace Garnet\Http\Middleware\userDataAuthentication;

use Garnet\Order;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthUserOrder
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = Order::find($request->order);
        $userId = $order->user_id;

        if(!roles('Administrator'))
        {
            if(Auth::user()->id != $userId)
                return response(view('warnings.unauthorized'));
        }

        return $next($request);
    }
}
