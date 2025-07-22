<?php

namespace App\Http\Controllers;

use App\Helpers\JwtHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $payload = [
            'sub' => $user->id,
            'iat' => time(),
        ];

        $token = JwtHelper::encode($payload, config('app.key'));

        return response()->json(['token' => $token]);
    }

    public function validarToken(Request $request)
    {

        try {
            $authHeader = $request->header('Authorization');

            if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
                return response()->json(['message' => 'Token no proporcionado'], 401);
            }

            $token = str_replace('Bearer ', '', $authHeader);

            $decoded = \App\Helpers\JwtHelper::decode($token, config('app.key'));

            if (!$decoded || !isset($decoded['sub'])) {
                return response()->json(['message' => 'Token inválido'], 401);
            }

            $user = \App\Models\User::find($decoded['sub']);

            if (!$user) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }

            return response()->json(['user' => $user], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error al procesar el token',
                'error' => $e->getMessage()
            ], 401);
        }
    }
}
