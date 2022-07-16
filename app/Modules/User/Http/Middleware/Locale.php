<?php

namespace App\Modules\User\Http\Middleware;

use Closure;

class Locale
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
        $locale = $request->segment(1);
        $locale = strtolower($locale);

        config(['app.locale' => $locale]);
        
        return $next($request);
    }
}
