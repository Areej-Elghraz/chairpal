<?php

namespace App\Http\Controllers;

use App\Models\EmergencyContact;
use Illuminate\Http\Request;

class EmergencyContactController extends ApiController
{
    /**
     * Display a listing of the emergency contacts.
     */
    public function index(Request $request)
    {
        $contacts = $request->user()->emergencyContacts()->get();

        return response()->json([
            'message' => 'Emergency contacts retrieved successfully.',
            'data' => $contacts
        ]);
    }

    /**
     * Store a newly created emergency contact in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $contact = $request->user()->emergencyContacts()->create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json([
            'message' => 'Emergency contact added successfully.',
            'data' => $contact
        ], 201);
    }

    /**
     * Remove the specified emergency contact from storage.
     */
    public function destroy(Request $request, EmergencyContact $emergencyContact)
    {
        if ($emergencyContact->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $emergencyContact->delete();

        return response()->json([
            'message' => 'Emergency contact deleted successfully.',
        ]);
    }
}
