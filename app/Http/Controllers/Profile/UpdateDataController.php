<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Profile\UpdateDataRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UpdateDataController extends ApiController
{
    public function __invoke(UpdateDataRequest $request)
    {
        $user = User::findOrFail(auth('sanctum')->id());

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->getRawOriginal('image'))) {
                Storage::disk('public')->delete($user->getRawOriginal('image'));
            }
            $path = $request->file('image')->store('avatars', 'public');
        }

        $user->update([
            'name'                 => $request->name ?? $user->name,
            'email'                => $request->email ?? $user->email,
            'phone'                => $request->phone ?? $user->phone,
            'image'                => $path ?? null,
            'logout_other_devices' => $request->logout_other_devices ?? false,
        ]);

        return $this->successResponse(message: __('auth.profile_data_changed_success'));
    }
}
