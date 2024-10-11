<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JwtAuth
{
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        try {
            $decrypted = Crypt::decryptString($token);
            list($userId, $expiresAt) = explode('|', $decrypted);

            if (now()->timestamp > $expiresAt) {
                return response()->json(['error' => 'Token expired'], 401);
            }

            $user = User::find($userId);

            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }

            Auth::setUser($user);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

