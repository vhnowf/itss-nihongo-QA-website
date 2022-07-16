<?php

namespace App\Modules\User\Http\Middleware;

use Closure;

class UserAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth()->check()) {
            return $next($request);
        } else {
            return redirect()->route('homes.index', ['login' => 1]);
        }
    }
}
