<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = 'user')
    { 
        if (! Auth::guard($guard)->check()) {
            return redirect(route('pages.login'));
        }
        return $next($request);
    }
}