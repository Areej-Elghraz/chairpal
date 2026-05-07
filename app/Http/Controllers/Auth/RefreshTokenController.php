<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
// use App\Http\Requests\Auth\RefreshTokenRequest;
use App\Services\GenerateTokensService;

class RefreshTokenController extends ApiController
{
    public function __invoke(GenerateTokensService $generateTokensService)
    {
        /**
         * @var \App\Models\User $user
         */
        // $deviceRequest = $request->input('device');
        $user   = auth('sanctum')->user();
        $tokens = $generateTokensService($user, true);
        return $this->successResponse(__('messages.token_generated'), parameters: [
            'access_token'              => $tokens['access_token'],
            'access_token_expires_in'   => $tokens['access_token_expiration'],
            'remember_token'            => $tokens['remember_token'],
            'remember_token_expires_in' => $tokens['remember_token_expiration'],
        ]);
    }
}
