<?php

namespace App\Modules\Admin\Http\Middleware;

use App;
use Closure;
use Session;

class LocaleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('lang-admin')) {
            App::setLocale(Session::get('lang-admin'));
        }

        return $next($request);
    }
}
