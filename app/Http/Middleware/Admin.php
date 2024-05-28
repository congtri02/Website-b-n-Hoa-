<?php
namespace App\Http\Middleware;
use Closure;
use Auth;
use Session;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (! Auth::guard('admin')->check()) {
            
            return redirect(route('admin.login'));
        }

        return $next($request);
    }
}
