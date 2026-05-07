<?php

namespace App\Http\Controllers;

use App\Models\EChair;
use Illuminate\Http\Request;

class EChairController extends Controller
{
    /**
     * Verify an E-Chair serial number and assign it to the user.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'serial_number' => 'required|string',
        ]);

        $eChair = EChair::where('serial_number', $request->serial_number)->first();

        if (!$eChair) {
            return response()->json([
                'message' => 'Invalid serial number.',
            ], 404);
        }

        if ($eChair->assigned_to_user_id && $eChair->assigned_to_user_id !== $request->user()->id) {
            return response()->json([
                'message' => 'This E-Chair is already assigned to another user.',
            ], 403);
        }

        // Assign to user if not already assigned
        if (!$eChair->assigned_to_user_id) {
            $eChair->update([
                'assigned_to_user_id' => $request->user()->id,
                'status' => 'active',
            ]);
        }

        return response()->json([
            'message' => 'E-Chair verified and connected successfully.',
            'data' => $eChair
        ]);
    }

    /**
     * Update E-Chair status (battery, etc.)
     */
    public function status(Request $request)
    {
        $request->validate([
            'battery' => 'nullable|integer|min:0|max:100',
            'status' => 'nullable|string'
        ]);

        // Find the user's connected e-chair
        $eChair = $request->user()->eChairs()->first();

        if (!$eChair) {
            return response()->json([
                'message' => 'No E-Chair connected to this user.',
            ], 404);
        }

        // Update basic status if needed. Or we can just log it.
        if ($request->has('status')) {
            $eChair->update(['status' => $request->status]);
        }

        // If battery is < 10%, we could trigger a notification here.
        // For now we just return success.
        return response()->json([
            'message' => 'E-Chair status updated.',
        ]);
    }
}
