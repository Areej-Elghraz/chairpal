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
            'content'  => 'nullable|string',
            'images.*' => 'image|max:2048',
            'files.*'  => 'file|max:5120',
        ];
    }
}
