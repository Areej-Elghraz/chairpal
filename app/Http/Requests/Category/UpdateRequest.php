<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'               => 'sometimes|required|string|max:255',
            'parent_id'          => 'sometimes|nullable|exists:categories,id',
            'organization_ids'   => 'sometimes|nullable|array',
            'organization_ids.*' => 'required|exists:organizations,id',
            'image'              => 'sometimes|image|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }
}