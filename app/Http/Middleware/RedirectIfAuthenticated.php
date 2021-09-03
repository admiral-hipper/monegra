<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // todo: проверить необходимость этой проверки и если не нужно убрать ее
            if(Auth::user()->is_admin) {
                return redirect('/admin');
            }

            return redirect('/dashboard');
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
