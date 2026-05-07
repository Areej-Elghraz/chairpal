<?php

namespace App\Http\Requests\Profile;

use App\Enums\LanguagePreferenceEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class UpdateLanguageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'language' => ['required', new Enum(LanguagePreferenceEnum::class)],
        ];
    }
}
