<?php

namespace App\Http\Requests\Community;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'files' => 'nullable|array',
            'files.*' => 'file|max:5120',
        ];
    }
}
