<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = ['user_id', 'visitable_id', 'visitable_type'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function visitable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
