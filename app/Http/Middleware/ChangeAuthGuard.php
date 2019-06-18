<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ChangeAuthGuard
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard)
    {
//        app()->singleton('auth.driver', function ($app) use ($guard) {
//            return $app['auth']->guard($guard);
//        });
        config(['auth.defaults.guard' => $guard]);

        return $next($request);
    }
}
