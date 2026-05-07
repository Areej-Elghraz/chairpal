<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\VerifyOtpRequest;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VerifyOtpController extends ApiController
{
    public function __invoke(VerifyOtpRequest $request)
    {
        $user       = User::firstWhere('email', $request->email);
        $expiration = config('auth.passwords.users.expire', 180); //minutes
        $otpRecord  = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if (!$otpRecord) {
            abort(404, __('validation.invalid_value', ['attribute' => __('validation.attributes.otp')]));
        }

        if ($otpRecord->verified) {
            abort(409, __('auth.already_verified', ['attribute' => __('validation.attributes.otp')]));
        }

        $createdAt    = \Carbon\Carbon::parse($otpRecord->created_at);
        $minutesSince = $createdAt->diffInMinutes(now());
        
        if ($minutesSince >= $expiration) {
            abort(410, __('auth.code_expired'));
        }

        if (!Hash::check($request->otp, $otpRecord->token)) {
            throw ValidationException::withMessages(['otp' => __('validation.invalid_value', ['attribute' => __('validation.attributes.otp')])]);
        }

        DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->update([
                'verified' => true,
            ]);
        // ->delete();

        return $this->successResponse(__('auth.verified_successfully', ['attribute' => __('validation.attributes.otp')]));
    }
}
