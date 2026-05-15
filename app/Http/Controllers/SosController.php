<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SosController extends ApiController
{
    /**
     * Trigger SOS alert.
     */
    public function trigger(Request $request)
    {
        $request->validate([
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $user = $request->user();
        $contacts = $user->emergencyContacts()->get();

        if ($contacts->isEmpty()) {
            return response()->json([
                'message' => 'No emergency contacts found to alert.',
            ], 400);
        }

        $locationLink = ($request->latitude && $request->longitude) 
            ? "https://www.openstreetmap.org/?mlat={$request->latitude}&mlon={$request->longitude}#map=18/{$request->latitude}/{$request->longitude}"
            : "Location not provided.";

        // Mock sending Push Notification / SMS
        foreach ($contacts as $contact) {
            Log::info("SOS ALERT to {$contact->name} ({$contact->phone}): Emergency Alert! {$user->name} needs help now. Location: {$locationLink}");
        }

        return response()->json([
            'message' => 'SOS alert sent successfully to ' . $contacts->count() . ' contacts.',
        ]);
    }

    /**
     * Cancel SOS alert.
     */
    public function cancel(Request $request)
    {
        $user = $request->user();
        $contacts = $user->emergencyContacts()->get();

        // Mock sending cancellation
        foreach ($contacts as $contact) {
            Log::info("SOS CANCEL to {$contact->name} ({$contact->phone}): The emergency alert for {$user->name} has been cancelled.");
        }

        return response()->json([
            'message' => 'SOS alert cancelled successfully.',
        ]);
    }
}
