<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VerifyEmailController extends ApiController
{
    public function __invoke(VerifyEmailRequest $request, \App\Services\UserService $userService)
    {
        $user = User::where('email', $request->email)->firstOrFail();

        // Check if already verified
        if ($user->email_verified_at) {
            abort(409, __('auth.already_verified', ['attribute' => __('validation.attributes.email')]));
        }

        // Ensure verification code exists
        if (!$user->email_verification_code) {
            abort(422, __('auth.no_verification_code'));
        }

        // Calculate expiration
        if (!$user->email_verification_code_expires_at || now()->gt($user->email_verification_code_expires_at)) {
            abort(410, __('auth.code_expired'));
        }

        // Verify code
        if (!Hash::check($request->code, $user->email_verification_code)) {
            throw ValidationException::withMessages(['code' => __('auth.invalid_code')]);
        }

        // Update user
        $user->forceFill([
            'email_verified_at' => now(),
            'email_verification_code' => null,
            'email_verification_code_expires_at' => null,
            'email_verification_times_sent' => 0,
        ])->save();

        $userService->clearUserCache($user);

        return $this->successResponse(__('auth.verified_successfully', ['attribute' => __('validation.attributes.email')]), 200);
    }
}
