<?php

namespace App\Http\Requests\Auth;

use App\Enums\DeviceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class RefreshTokenRequest extends FormRequest
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
            // 'device'      => 'required|array',
            // 'device.id'   => 'required|string',
            // 'device.name' => 'required|string',
            // 'device.type' => ['required', new Enum(DeviceTypeEnum::class)], // add DeviceTypeEnum
        ];
    }
}
