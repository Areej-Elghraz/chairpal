<?php

namespace App\Core;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EventBus
{
    /**
     * Dispatch a unified system event across the system with Deduplication.
     * Critical events use synchronous dispatching (Fast Lane).
     */
    public static function dispatch(UnifiedSystemEvent $event): void
    {
        $eventHash = $event->getEventHash();

        // Deduplication Layer: Use Cache with atomic check to prevent double execution
        if (!Cache::add("dedup_{$eventHash}", true, now()->addMinutes(10))) {
            Log::warning("EventBus: Duplicate event detected and ignored. Hash: {$eventHash}");
            return;
        }

        // Check for Fast Lane criteria (Critical severity + Specific types)
        $isFastLane = $event->severity === 'critical' && in_array($event->type, ['emergency', 'obstacle']);

        if ($isFastLane) {
            Log::info("EventBus: Dispatching through FAST LANE (Sync). Hash: {$eventHash}");
            Event::dispatch('system.event.fast_lane', $event);
        } else {
            Log::info("EventBus: Dispatching through Normal Lane (Async). Hash: {$eventHash}");
            Event::dispatch('system.event', $event);
        }
    }
}
