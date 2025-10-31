<?php

namespace App\Services;

use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\InvalidVerificationLinkException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
            event(new Registered($user));

            $token = $user->createToken('auth-token')->plainTextToken;

            Log::info("User with email $data->email registered successfully.");

            return [
                'user' => $user,
                'token' => $token,
                'message' => 'Registration successful. Please check your email to verify your account.',
            ];
        });
    }

    public function login(LoginRequest $credentials): array
    {
        Log::info("Logining user with email {$credentials->email}.");
        $user = User::where('email', $credentials->email)->first();

        if (!$user || !Hash::check($credentials->password, $user->password)) {
            Log::error("No user found by email $credentials->email.");
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

    public function logout(Request $request): void
    {
        $request->user()->currentAccessToken()->delete();
        Log::info("User with email {$request->user()->email} was successfully logged out.");
    }

    public function verifyEmail($id, $hash): void
    {
        $user = User::find($id);

        if (!$user || !hash_equals($hash, sha1($user->getEmailForVerification()))) {
            Log::error("User with email {$user->email} is not verified.");
            throw new InvalidVerificationLinkException('Invalid verification link');
        }

        if ($user->hasVerifiedEmail()) {
            Log::error("User with email {$user->email} is already verified.");
            throw new EmailAlreadyVerifiedException('Email already verified');
        }

        if ($user->markEmailAsVerified()) {
            Log::info("User with email {$user->email} is now verified.");
            event(new Verified($user));
        }
    }
}
