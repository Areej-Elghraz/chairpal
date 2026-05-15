<?php

namespace App\Engines;

use App\Models\Trip;
use App\Models\EmergencyEvent;
use App\Models\DeviceStatus;

class TripStateMachine
{
    /**
     * Allowed transitions for trip status.
     */
    protected static array $transitions = [
        'pending' => ['active', 'cancelled'],
        'active' => ['paused', 'emergency_paused', 'locally_stopped', 'completed', 'cancelled'],
        'paused' => ['active', 'cancelled'],
        'emergency_paused' => ['active', 'cancelled'],
        'locally_stopped' => ['active', 'cancelled'],
    ];

    /**
     * Validate if a transition is allowed and passes all guards.
     */
    public static function validate(Trip $trip, string $newStatus): array
    {
        // 1. Check if basic transition is allowed
        if (!in_array($newStatus, self::$transitions[$trip->status] ?? [])) {
            return ['allowed' => false, 'reason' => "Invalid status transition from {$trip->status} to {$newStatus}"];
        }

        // 2. Guards for transitioning back to 'active'
        if ($newStatus === 'active') {
            
            // Guard: Emergency Unresolved
            $unresolvedEmergency = EmergencyEvent::where('trip_id', $trip->id)
                ->whereNull('resolved_at')
                ->exists();
            if ($unresolvedEmergency) {
                return ['allowed' => false, 'reason' => 'Guard failed: Unresolved emergency events linked to this trip'];
            }

            // Guard: Device Offline (Degraded/Offline)
            $offlineDevices = DeviceStatus::where('e_chair_id', $trip->e_chair_id)
                ->whereIn('connection_status', ['offline', 'degraded_connection'])
                ->exists();
            if ($offlineDevices) {
                // In a production environment, we might allow degraded, but here we enforce safety
                return ['allowed' => false, 'reason' => 'Guard failed: One or more critical hardware components are offline or degraded'];
            }
        }

        return ['allowed' => true];
    }
}
