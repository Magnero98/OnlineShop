<?php

namespace App\Http\Middleware\userDataAuthentication;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthUserProfile
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
        $user = Auth::user();

        if(!roles('Administrator'))
        {
            if($user->id != $request->user)
                return response(view('warnings.unauthorized'));
        }

        return $next($request);
    }
}
