<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Load the role relationship if it's not already loaded
        $user = Auth::user()->load('role');

        // Check if the user's role name matches the required role
        if (in_array($user->role->name, $roles)) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }
}

