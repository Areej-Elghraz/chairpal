<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:6', // confirmed
            'language' => ['sometimes', new \Illuminate\Validation\Rules\Enum(\App\Enums\LanguagePreferenceEnum::class)],
            'phone' => 'sometimes|nullable|phone:AUTO,MOBILE|unique:users,phone',
            'role' => 'sometimes|nullable|string|in:user,organization',
            // 'policies'   => 'required|boolean',
            // 'url'        => 'required|url',
            // user
            'phone' => 'required_if:role,user|phone:AUTO,MOBILE|unique:users,phone',
            'age' => 'required_if:role,user|integer',
            'follow_doctor' => 'required_if:role,user|boolean',
            // organization
            'latitude' => 'required_if:role,organization|numeric|between:-90,90',
            'longitude' => 'required_if:role,organization|numeric|between:-180,180',
            'country_name' => 'required_if:role,organization|string|max:255',
            'city_name' => 'required_if:role,organization|string|max:255',

            'category_id' => 'sometimes|nullable|required_if:role,organization|exists:categories,id',
            'category_name' => 'sometimes|required_if:role,organization|required_without:category_id|string|max:255',

            'image' => 'required_if:role,organization|image|mimes:png,jpg,jpeg,gif|max:2048',
            'description' => 'sometimes|nullable|string',

            // 'location'      => 'sometimes|nullable|string',
            // 'category_name' => 'required_if:role,organization|string|max:255',
            // 'device_id'   => 'required|string',
            // 'device_name' => 'required|string',
            // 'device_type' => 'required|string',

            // 'avatar'   => 'nullable|image|mimes:png,jpg,jpeg',
        ];
    }
}
