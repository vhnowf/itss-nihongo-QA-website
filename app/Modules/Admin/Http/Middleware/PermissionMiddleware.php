<?php

namespace App\Modules\Admin\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class PermissionMiddleware
{
    public function handle($request, Closure $next, $permission)
    {
        if (auth()->guest()) {
            throw UnauthorizedException::notLoggedIn();
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (auth()->user()->can($permission)) {
                return $next($request);
            }
        }

        throw UnauthorizedException::forPermissions($permissions);
    }
}
