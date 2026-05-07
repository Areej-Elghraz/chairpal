<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id', 'likeable_id', 'likeable_type'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likeable()
    {
        return $this->morphTo();
    }
}
