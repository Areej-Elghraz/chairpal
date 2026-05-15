<?php

namespace App\Services;

use App\Mail\OtpMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class GenerateCodeService
{
  public function otpCode(User $user)
  {
    $otpRecord  = DB::table('password_reset_tokens')->where('email', $user->email)->first();
    $expiration = config('auth.passwords.users.expire', 180); //seconds
    $throttle   = config('auth.passwords.users.throttle', 60); //seconds
    $maxTimes   = config('auth.passwords.users.times', 3); //times

    if ($otpRecord) {
      $createdAt    = \Carbon\Carbon::parse($otpRecord->created_at);
      $secondsSince = $createdAt->diffInSeconds(now());
      $times        = $otpRecord->times ?? 0;
      if ($secondsSince > $expiration) {
        $times = 0;
      }
      if ($times >= $maxTimes) {
        if ($secondsSince <= $throttle) {
          throw new \Exception(__('auth.wait_before_resend', ['attribute' => __('validation.attributes.otp'), 'seconds' => $throttle, 'remain_seconds' => (int) ($throttle - $secondsSince)]), 429);
        }
        $times = 0;
      }
    }

    $otp      = random_int(1000, 9999);
    $newTimes = ($times ?? 0) + 1;

    DB::table('password_reset_tokens')->updateOrInsert(
      ['email' => $user->email],
      [
        'token'      => Hash::make($otp),
        'created_at' => now(),
        'times'      => $newTimes,
        'verified'   => false,
      ]
    );

    $this->sendMail($user, $otp, $expiration, $maxTimes, $newTimes);
  }
  public function verificationCode(User $user)
  {
    $vCode      = $user->email_verification_code;
    $expiresAt  = $user->email_verification_code_expires_at;
    $times      = $user->email_verification_times_sent;
    $expiration = config('auth.verification_codes.users.expire', 180); //seconds
    $throttle   = config('auth.verification_codes.users.throttle', 60); //seconds
    $maxTimes   = config('auth.verification_codes.users.times', 3); //times

    if ($vCode) {
      $secondsSince = now()->diffInSeconds($expiresAt, false);
      if (!$secondsSince) {
        $times = 0;
      }
      if ($times >= $maxTimes) {
        if ($secondsSince <= $throttle) {
          throw new \Exception(__('messages.wait_before_resend', ['attribute' => __('validation.attributes.code'), 'seconds' => $throttle, 'remain_seconds' => (int) ($throttle - $secondsSince)]), 429);
        }
        $times = 0;
      }
    }

    $code     = random_int(1000, 9999);
    $newTimes = ($times ?: 0) + 1;

    $user->update([
      'email_verification_code'            => $code,
      'email_verification_code_expires_at' => now()->addSeconds(config('auth.verification_codes.users.expire')),
      'email_verification_times_sent'      => $newTimes,
    ]);

    $this->sendMail($user, $code, $expiration, $maxTimes, $newTimes);
  }
  public function sendMail(User $user, string $code, int $expiration, int $maxTimes, int $newTimes)
  {
    try {
      Mail::to($user->email)->send(new OtpMail($code));
    } catch (\Exception $e) {
      Log::error("Failed to send OTP to {$user->email}: " . $e->getMessage());
    }
  }
}
