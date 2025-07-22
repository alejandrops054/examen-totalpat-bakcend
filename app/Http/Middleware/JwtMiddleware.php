<?php

namespace App\Http\Middleware;

use App\Helpers\JwtHelper;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class JwtMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $secret = config('app.key');
        $payload = JwtHelper::decode($token, $secret);
        if (!$payload || !isset($payload['sub'])) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $request->setUserResolver(function () use ($payload) {
            return User::find($payload['sub']);
        });

        return $next($request);
    }
}
