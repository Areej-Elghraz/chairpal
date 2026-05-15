<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class DeleteAccountController extends ApiController
{
    /**
     * Delete the authenticated user's account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        $user = $request->user();
        
        // Delete all user tokens
        $user->tokens()->delete();
        
        // Delete the user
        $user->delete();

        return response()->json([
            'message' => __('messages.account_deleted')
        ], 200);
    }
}
