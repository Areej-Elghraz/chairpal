<?php

namespace App\Services;

use App\Models\EmergencyEvent;
use App\Models\Trip;
use App\Models\IncidentReport;
use Illuminate\Support\Facades\Log;

class EmergencyOrchestratorService
{
    public function handleEmergency(EmergencyEvent $event)
    {
        // 1. Log the occurrence regardless of trip
        Log::critical("EMERGENCY DETECTED: {$event->event_type} for E-Chair #{$event->e_chair_id}");

        // 2. Integration with Trip Management
        if ($event->trip_id) {
            $trip = $event->trip;
        } else {
            // Try to find active trip
            $trip = Trip::where('e_chair_id', $event->e_chair_id)
                ->where('status', 'active')
                ->first();
        }

        if ($trip && $trip->status === 'active') {
            $trip->update(['status' => 'emergency_paused']);
            
            // Link event to trip if not already linked
            if (!$event->trip_id) {
                $event->update(['trip_id' => $trip->id]);
            }
        }

        // 3. Create Incident Report for high severity
        if (in_array($event->severity, ['high', 'critical'])) {
            IncidentReport::create([
                'event_type' => 'emergency',
                'event_id' => $event->id,
                'description' => "Emergency event: {$event->event_type} classification: {$event->source_classification}",
                'severity' => $event->severity === 'critical' ? 'critical' : 'high',
                'status' => 'open',
                'metadata' => [
                    'e_chair_id' => $event->e_chair_id,
                    'trip_id' => $event->trip_id,
                    'location' => $event->location
                ]
            ]);
        }

        // 4. Trigger Notifications (Mock)
        // Send to assistant/caregiver
        Log::info("NOTIFICATION SENT TO ASSISTANT for Emergency #{$event->id}");

        return true;
    }
}
