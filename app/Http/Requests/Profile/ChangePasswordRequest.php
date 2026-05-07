<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        // $rules = [
        //     'new_password' => 'required|password|confirmed|min:6',
        //     ];
        //     if (auth('sanctum')->user()->password_set) {
        //         array_merge($rules, [
        //             'current_password' => 'required|password',
        //             ]);
        //             }
        //             return $rules;
        return [
            'current_password' => 'required|string',
            'new_password'     => 'required|string|confirmed|min:6',
        ];
    }
}
