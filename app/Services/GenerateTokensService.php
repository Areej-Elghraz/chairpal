<?php

namespace App\Services;

use App\Models\User;
use App\Enums\TokenAbilityEnum;

class GenerateTokensService
{
  public function __invoke(User $user, bool $remember = false): array
  {
    $user->tokens()->delete();
    // if ($user->tokens()->exists()) {
    //   if ($user->logout_other_devices) {
    //     $user->tokens()->delete();
    //   }
    //   $user->tokens()->where('expires_at', '<', now())?->delete();
    //   $currentToken = $user->currentAccessToken();
    //   if ($currentToken instanceof \Laravel\Sanctum\PersonalAccessToken) {
    //     $currentToken->delete();
    //   }
    // }

    $accessToken = $user->createToken(
      'access_token_' . $user->id,
      [TokenAbilityEnum::ACCESS_TOKEN->value],
      now()->addSeconds(config('sanctum.access_expiration'))
    )->plainTextToken;

    if ($remember) {
      $rememberToken = $user->createToken(
        'remember_token_' . $user->id,
        [TokenAbilityEnum::REMEMBER_TOKEN->value],
        now()->addSeconds(config('sanctum.remember_expiration'))
      )->plainTextToken;
    }
    return [
      'access_token'              => $accessToken,
      'access_token_expiration'   => config('sanctum.access_expiration'),
      'remember_token'            => $rememberToken ?? null,
      'remember_token_expiration' => config('sanctum.remember_expiration'),
    ];
  }
}
