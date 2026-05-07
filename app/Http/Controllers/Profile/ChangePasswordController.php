<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Profile\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends ApiController
{
    public function __invoke(ChangePasswordRequest $request)
    {
        /**
         * @var App\Models\User $user
         */
        // dd($request->all());
        $user = User::findOrFail(auth('sanctum')->id());
        if ($request->current_password && !Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages(['current_password' => __('validation.invalid_value', ['attribute' => 'current_password'])]);
        }
        if ($request->current_password === $request->new_password) {
            throw ValidationException::withMessages(['new_password' => __('validation.new_password_must_differ', ['attribute' => 'new_password'])]);
        }
        $user->update([
            'password' => $request->new_password,
        ]);
        return $this->successResponse(message: __('auth.password_changed_success'));
    }
}
