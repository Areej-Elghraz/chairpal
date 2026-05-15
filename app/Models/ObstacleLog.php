<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ObstacleLog extends Model
{
    protected $fillable = [
        'e_chair_id',
        'location',
        'obstacle_type',
        'distance_to_obstacle',
        'timestamp_ms',
    ];

    protected $casts = [
        'location' => 'array',
    ];

    public function eChair(): BelongsTo
    {
        return $this->belongsTo(EChair::class, 'e_chair_id');
    }
}
