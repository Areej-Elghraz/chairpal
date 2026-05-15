<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\GenerateTokensService;
use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends ApiController
{
    public function __invoke(LoginRequest $request, GenerateTokensService $generateTokensService, UserService $userService)
    {
        // $deviceRequest = $request->input('device');

        $user = $userService->getUserByEmail($request->email);

        if (!$user) {
            throw ValidationException::withMessages(['email' => __('auth.failed')]);
        }


        // dd(Auth::attempt($request->only('email', 'password')));

        if (!Auth::attempt($request->only('email', 'password'))) {
            return $this->errorResponse(
                __('auth.failed'),
                401,
            );
        }

        // dd(auth('sanctum')->user());
        $user   = auth('sanctum')->user();
        $tokens = $generateTokensService($user, $request->remember ?? false);

        return $this->successResponse(message: __('auth.login_success'), parameters: [
            'user'                      => $user,
            'access_token'              => $tokens['access_token'],
            'access_token_expires_in'   => $tokens['access_token_expiration'],
            'remember_token'            => $tokens['remember_token'],
            'remember_token_expires_in' => $tokens['remember_token_expiration'],
        ]);
    }
}
