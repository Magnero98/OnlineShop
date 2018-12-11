<?php

namespace App\Http\Middleware\userRoleAuthentication;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthorized
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
        if(Auth::user() != null)
            return $next($request);

        return response(view('warnings.unauthorized'));
    }
}
