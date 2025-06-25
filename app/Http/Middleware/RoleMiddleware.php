<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        $roleArray = explode(',', $roles);

        if (in_array($user->role, $roleArray)) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
