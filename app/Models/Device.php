<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Device extends Model
{
    protected $fillable = [
        'name',
        'type',
        // 'user_id',
        'ip',
        'last_used_at'
    ];

    // protected $casts = [
    //     'last_used_at' => 'datetime'
    // ];

    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo('users');
    // }
}
