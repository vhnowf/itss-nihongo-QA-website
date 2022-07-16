<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     * @param Closure $next
     * @param string  $guard
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function handle($request, Closure $next, $guard = 'web')
    {
        $segments = $request->segments();
        $currentURL = implode('/', $segments);
        // dd(Auth::guard($guard)->user()->role != 'admin');
        if (Auth::guard($guard)->user()->role != 'admin') {
            return redirect('admin/login');
        }
        // if (Auth::guard($guard)->guest()) {
        //     if ($request->ajax() || $request->wantsJson()) {
        //         return response('Unauthorized.', 401);
        //     } else {
        //         if ($currentURL != 'admin/login') {
        //             $request->session()->put('admin_redirect_url', $currentURL);
        //         }

        //         return redirect('admin/login');
        //     }
        // }

        return $next($request);
    }
}
