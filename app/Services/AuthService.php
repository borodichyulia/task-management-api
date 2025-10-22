<?php

namespace App\Services;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(RegisterRequest $data): array
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data->name,
                'email' => $data->email,
                'password' => Hash::make($data->password),
            ]);

            $token = $user->createToken('auth-token')->plainTextToken;

            return [
                'user' => $user,
                'token' => $token,
            ];
        });
    }

    public function login(LoginRequest $credentials): array
    {
        $user = User::where('email', $credentials->email)->first();

        if (!$user || !Hash::check($credentials->password, $user->password)) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'Invalid credentials',
                ], 401)
            );
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function logout(Request $request): void{
        $request->user()->currentAccessToken()->delete();
    }
}
