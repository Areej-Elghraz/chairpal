<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DecisionTraceLog extends Model
{
    protected $fillable = [
        'event_type',
        'event_id',
        'decisions',
        'reasoning',
        'latency_ms',
        'timestamp_ms',
    ];

    protected $casts = [
        'decisions' => 'array',
    ];
}
