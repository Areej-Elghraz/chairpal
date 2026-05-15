<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Trip extends Model
{
    protected $fillable = [
        'user_id',
        'e_chair_id',
        'start_location',
        'end_location',
        'status',
        'navigation_mode',
        'start_time',
        'end_time',
        'total_distance',
        'total_time',
        'metadata',
    ];

    protected $casts = [
        'start_location' => 'array',
        'end_location' => 'array',
        'metadata' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function eChair(): BelongsTo
    {
        return $this->belongsTo(EChair::class, 'e_chair_id');
    }

    public function updates(): HasMany
    {
        return $this->hasMany(TripUpdate::class);
    }

    public function emergencyEvents(): HasMany
    {
        return $this->hasMany(EmergencyEvent::class);
    }
}
