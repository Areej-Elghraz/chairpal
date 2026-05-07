<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\ResendVerificationCodeRequest;
use App\Models\User;
use App\Services\GenerateCodeService;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\returnCallback;

class ResendVerificationCodeController extends ApiController
{
    public function __invoke(ResendVerificationCodeRequest $request, GenerateCodeService $generateCodeService)
    {
        $user = User::firstWhere('email', $request->email);
        if ($user->email_verified_at) {
            throw ValidationException::withMessages(['email' => __('auth.already_verified', ['attribute' => __('validation.attributes.email')])]);
        }
        $generateCodeService->verificationCode($user);
        // $generateCodeService->verificationCode($user, $request->url);
        return $this->successResponse(__('auth.verification_code_resent', ['attribute' => __('validation.attributes.code')]));
    }
}
