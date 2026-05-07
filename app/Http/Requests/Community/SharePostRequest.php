<?php

namespace App\Http\Requests\Community;

use Illuminate\Foundation\Http\FormRequest;

class SharePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'nullable|string|max:1000',
        ];
    }
}
