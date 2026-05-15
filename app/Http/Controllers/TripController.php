<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\TripUpdate;
use App\Engines\TripStateMachine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TripController extends ApiController
{
    public function index(Request $request)
    {
        $trips = Trip::where('user_id', Auth::id())
            ->with(['eChair'])
            ->latest()
            ->paginate(15);

        return $this->successResponse(
            message: 'Trips retrieved successfully',
            parameters: ['trips' => $trips]
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'e_chair_id' => 'required|exists:e_chairs,id',
            'start_location' => 'required|array',
            'end_location' => 'required|array',
            'navigation_mode' => 'nullable|string|in:autonomous,manual,assisted',
            'metadata' => 'nullable|array',
        ]);

        $trip = Trip::create([
            'user_id' => Auth::id(),
            'e_chair_id' => $validated['e_chair_id'],
            'start_location' => $validated['start_location'],
            'end_location' => $validated['end_location'],
            'navigation_mode' => $validated['navigation_mode'] ?? 'manual',
            'status' => 'pending',
            'start_time' => now(),
            'metadata' => $validated['metadata'] ?? [],
        ]);

        return $this->successResponse(
            message: 'Trip initiated successfully',
            status: 201,
            parameters: ['trip' => $trip]
        );
    }

    public function update(Request $request, Trip $trip)
    {
        $this->authorize('update', $trip);

        $validated = $request->validate([
            'status' => 'required|string|in:active,paused,emergency_paused,locally_stopped,completed,cancelled',
            'end_time' => 'nullable|date',
            'total_distance' => 'nullable|numeric',
            'total_time' => 'nullable|integer',
        ]);

        // State Machine & Guards Validation
        $validation = TripStateMachine::validate($trip, $validated['status']);
        
        if (!$validation['allowed']) {
            return $this->errorResponse(
                message: $validation['reason'],
                code: 400
            );
        }

        $trip->update($validated);

        if ($validated['status'] === 'completed' || $validated['status'] === 'cancelled') {
            $trip->update(['end_time' => $validated['end_time'] ?? now()]);
        }

        return $this->successResponse(
            message: 'Trip status updated successfully',
            parameters: ['trip' => $trip]
        );
    }

    public function addUpdate(Request $request, Trip $trip)
    {
        $this->authorize('update', $trip);

        $validated = $request->validate([
            'update_type' => 'required|string',
            'source' => 'required|string|in:user,ai,assistant,system',
            'update_data' => 'nullable|array',
            'timestamp_ms' => 'required|numeric',
        ]);

        $update = $trip->updates()->create($validated);

        return $this->successResponse(
            message: 'Trip update ingested',
            status: 202,
            parameters: ['update' => $update]
        );
    }
}
