<?php

namespace App\Services;

use App\Models\HealthPrediction;
use App\Models\HealthAlert;
use App\Models\Trip;
use Illuminate\Support\Facades\Log;

class HealthOrchestratorService
{
    public function handleNewPrediction(HealthPrediction $prediction)
    {
        // 1. Check if prediction is critical
        if (!$prediction->is_critical) {
            return;
        }

        // 2. Find active trip if exists for this e_chair
        $activeTrip = Trip::where('e_chair_id', $prediction->e_chair_id)
            ->whereIn('status', ['active', 'paused'])
            ->first();

        // 3. Generate HealthAlert
        $alert = HealthAlert::create([
            'health_prediction_id' => $prediction->id,
            'user_id' => $prediction->eChair->user_id ?? $activeTrip->user_id ?? null,
            'trip_id' => $activeTrip->id ?? null,
            'status' => 'open',
            'severity' => 'critical',
            'timestamp_ms' => $prediction->timestamp_ms,
        ]);

        // 4. Escalation Logic: If critical, escalate to EmergencyEvent
        // We'll call the EmergencyOrchestrator from the controller or here
        // For architectural purity, we'll return the alert and let the controller decide
        
        return $alert;
    }
}
