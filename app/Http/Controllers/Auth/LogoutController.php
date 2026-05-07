<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Auth\LogoutRequest;

class LogoutController extends ApiController
{
    public function __invoke(LogoutRequest $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return $this->successResponse(__('auth.logout_success'));
    }
}
