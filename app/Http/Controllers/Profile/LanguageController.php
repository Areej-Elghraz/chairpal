<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use App\Http\Requests\Profile\UpdateLanguageRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;

class LanguageController extends ApiController
{
    public function update(UpdateLanguageRequest $request)
    {
        $user = $request->user();
        $user->update(['language' => $request->language]);

        Cache::put("user:{$user->id}:language", $request->language, now()->addDays(30));
        App::setLocale($request->language);

        return $this->successResponse(
            message: __('messages.actions.updated_success', ['resource' => __('messages.resources.language.singular')]),
            status: 200,
            parameters: ['language' => $user->language]
        );
    }
}
