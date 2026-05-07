<?php

namespace App\Http\Requests\Chat;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content'    => 'required_without:attachment|string|nullable',
            'attachment' => 'required_without:content|file|max:5120',
        ];
    }
}
