<?php

namespace App\Http\Requests\Auth;

use App\Enums\DeviceTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class LogoutRequest extends FormRequest
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
            'all_devices' => 'nullable|boolean',
            'device'      => 'nullable|array',
            'device.id'   => 'nullable|string',
            'device.name' => 'nullable|string',
            'device.type' => ['nullable', new Enum(DeviceTypeEnum::class)], // add DeviceTypeEnum
        ];
    }
}
