<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class DeviceController extends ApiController
{
    public function __invoke(Request $request)
    {
        // $user = $request->user();
        // return $this->successResponse(message: __('auth.devices_success'), parameters: [
        //     'data' => $user->devices,
        // ]);
    }
}
