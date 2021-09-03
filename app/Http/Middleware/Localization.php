<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\{App, Auth, Session};
use Illuminate\Http\Request;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = Session::get('locale');

        if (!$locale) {
            $locale = Auth::check()
                ? Auth::user()->locale
                : config('app.locale');

            Session::put('locale', $locale);
        }

        App::setLocale($locale);

        return $next($request);
    }
}
