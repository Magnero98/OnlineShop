<?php

namespace Garnet\Http\Middleware\userRoleAuthentication;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdministrator
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
        if(Auth::user()->role->name != 'Administrator')
            return response(view('warnings.unauthorized'));

        return $next($request);
    }
}
