<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class SupportMessage extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
