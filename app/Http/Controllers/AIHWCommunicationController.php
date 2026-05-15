<?php

namespace App\Http\Controllers;

use App\Core\UnifiedSystemEvent;
use App\Core\EventBus;
use App\Models\AIStatusLog;
use App\Models\DeviceStatus;
use App\Models\EmergencyEvent;
use App\Models\ObstacleLog;
use App\Models\WheelchairEvent;
use App\Models\WheelchairTelemetry;
use App\Models\HealthSensorLog;
use App\Models\HealthPrediction;
use App\Models\Trip;
use Illuminate\Http\Request;

class AIHWCommunicationController extends ApiController
{
    public function telemetry(Request $request)
    {
        $validated = $request->validate([
            'e_chair_id' => 'required|exists:e_chairs,id',
            'position_data' => 'required|array',
            'speed' => 'nullable|numeric',
            'battery_level' => 'nullable|integer',
            'heading' => 'nullable|numeric',
            'status' => 'nullable|string',
            'timestamp_ms' => 'required|numeric',
        ]);

        $telemetry = WheelchairTelemetry::create($validated);

        return $this->successResponse(
            message: 'Telemetry ingested',
            status: 202,
            parameters: ['telemetry' => $telemetry]
        );
    }

    public function events(Request $request)
    {
        $validated = $request->validate([
            'e_chair_id' => 'required|exists:e_chairs,id',
            'event_type' => 'required|string',
            'event_data' => 'nullable|array',
            'severity' => 'nullable|string|in:info,warning,critical',
            'timestamp_ms' => 'required|numeric',
        ]);

        $event = WheelchairEvent::create($validated);

        // Normalize and Dispatch
        EventBus::dispatch(UnifiedSystemEvent::make(
            'hardware',
            'ai_hw_controller',
            $validated['severity'] ?? 'info',
            $validated,
            $validated['timestamp_ms']
        ));

        return $this->successResponse(
            message: 'Event ingested',
            status: 202,
            parameters: ['event' => $event]
        );
    }

    public function healthPredictions(Request $request)
    {
        $validated = $request->validate([
            'e_chair_id' => 'required|exists:e_chairs,id',
            'prediction_type' => 'required|string',
            'confidence' => 'required|numeric',
            'is_critical' => 'required|boolean',
            'source_model' => 'required|string',
            'prediction_window_ms' => 'nullable|integer',
            'details' => 'nullable|array',
            'timestamp_ms' => 'required|numeric',
        ]);

        $prediction = HealthPrediction::create($validated);

        // Normalize and Dispatch
        EventBus::dispatch(UnifiedSystemEvent::make(
            'health',
            'ai_health_inference',
            $validated['is_critical'] ? 'critical' : 'info',
            $validated,
            $validated['timestamp_ms']
        ));

        return $this->successResponse(
            message: 'Health prediction ingested and dispatched to EventBus',
            status: 202,
            parameters: ['prediction' => $prediction]
        );
    }

    public function emergency(Request $request)
    {
        $validated = $request->validate([
            'e_chair_id' => 'required|exists:e_chairs,id',
            'trip_id' => 'nullable|exists:trips,id',
            'event_type' => 'required|string',
            'source_classification' => 'required|string|in:obstacle,health,hardware,connectivity,battery,ai_failure',
            'location' => 'nullable|array',
            'severity' => 'required|string|in:info,warning,critical',
            'timestamp_ms' => 'required|numeric',
        ]);

        $emergency = EmergencyEvent::create($validated);

        // Normalize and Dispatch
        EventBus::dispatch(UnifiedSystemEvent::make(
            'emergency',
            'emergency_subsystem',
            $validated['severity'],
            $validated,
            $validated['timestamp_ms']
        ));
        
        return $this->successResponse(
            message: 'Emergency event recorded and dispatched',
            status: 201,
            parameters: ['emergency' => $emergency]
        );
    }

    // Other methods (aiLogs, deviceStatus, obstacleLogs, healthTelemetry) remain similar or dispatch events if needed
}
