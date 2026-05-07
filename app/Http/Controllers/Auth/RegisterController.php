<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\GenerateCodeService;
use App\Services\UserService;

class RegisterController extends ApiController
{
    public function __invoke(RegisterRequest $request, GenerateCodeService $generateCodeService, UserService $userService)
    {
        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('avatars', 'public');
        }

        $user = $userService->createUser($request->validated(), $path);
        
        $generateCodeService->verificationCode($user);
        
        return $this->successResponse(message: __('auth.register_success'));
    }
}
