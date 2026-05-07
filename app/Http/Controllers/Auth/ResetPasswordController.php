<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ResetPasswordController extends ApiController
{

    public function __invoke(ResetPasswordRequest $request, UserService $userService)
    {
        $validated = $request->validated();
        $user      = $userService->getUserByEmail($request->email);
        $otpRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages(['email' => __('validation.invalid_value', ['attribute' => __('validation.attributes.email')])]);
        }

        if (!$otpRecord || empty($otpRecord->verified) || !$otpRecord->verified) {
            throw new \Exception(__('auth.must_verify_first', ['attribute' => __('validation.attributes.otp')]), 403);
        }

        if (Hash::check($validated['new_password'], $user->password)) {
            throw ValidationException::withMessages(['new_password' => __('validation.new_password_must_differ')]);
        }

        $userService->updateUser($user, [
            'password' => Hash::make($validated['new_password']),
            'password_set' => true,
        ]);

        /// Fire reset event (optional)
        event(new PasswordReset($user));

        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->delete();

        $user->tokens()?->where('name', $user->currentAccessToken()?->name)->delete();

        return $this->successResponse(__('auth.password_reset_success'));
    }
}
