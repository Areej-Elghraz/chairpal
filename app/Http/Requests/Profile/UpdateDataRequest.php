<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataRequest extends FormRequest
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
            'name'                 => 'sometimes|required|string|max:255',
            'email'                => 'sometimes|required|email|unique:users,email,' . auth('sanctum')->id(),
            'logout_other_devices' => 'sometimes|required|boolean',
            // user
            'phone'                => 'sometimes|required|phone:AUTO,MOBILE|unique:users,phone,' . auth('sanctum')->id(), /// phone validation
            'age'                  => 'sometimes|required|integer',
            'follow_doctor'        => 'sometimes|required|boolean',
            // organization
            'location'             => 'sometimes|required|string',
            'image'                => 'sometimes|required|image|mimes:png,jpg,jpeg,gif|max:2048',
        ];
    }
}
