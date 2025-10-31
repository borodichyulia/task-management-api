<?php

namespace App\Http\Controllers;

use App\Constants\HttpStatuses;
use App\Exceptions\EmailAlreadyVerifiedException;
use App\Exceptions\InvalidVerificationLinkException;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request);

        return response()->json($result, HttpStatuses::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request);

        return response()->json($result);
    }

    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout($request);

        return response()->json([
            'message' => 'Logged out successfully',
        ]);
    }

    public function verifyEmail($id, $hash)
    {
        try {
            $this->authService->verifyEmail($id, $hash);
            return response()->json(['message' => 'Email successfully verified'], 200);
        } catch (EmailAlreadyVerifiedException|InvalidVerificationLinkException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }
    }
}
