<?php

namespace App\Http\Requests\Place;

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
            'name'               => 'sometimes|string|max:255',
            'description'        => 'sometimes|string',
            'organization_id'    => 'sometimes|exists:organizations,id',
            'category_id'        => 'sometimes|required_without:category_name|exists:categories,id',
            'category_name'      => 'sometimes|required_without:category_id|string|max:255',
            'country_name'       => 'sometimes|required_without:country_id|string|max:255',
            'city_name'          => 'sometimes|required_without:city_id|string|max:255',
            'latitude'           => 'sometimes|numeric|between:-90,90',
            'longitude'          => 'sometimes|numeric|between:-180,180',
            'image'              => 'sometimes|image|mimes:png,jpg,jpeg,gif|max:2048',
            'accessibility_data' => 'nullable|array',
        ];
    }
}
