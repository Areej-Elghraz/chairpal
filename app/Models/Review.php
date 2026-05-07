<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Review extends Model
{
    protected $fillable = ['user_id', 'reviewable_id', 'reviewable_type', 'rating', 'comment'];

    protected $hidden = [
        'user_id',
        'reviewable_id',
        'reviewable_type',
    ];

    public const ALLOWED_RELATIONS = [
        'user',
        'reviewable',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reviewable()
    {
        return $this->morphTo();
    }

    // public function place()
    // {
    //     return $this->belongsTo(Place::class);
    // }

    // public function organization()
    // {
    //     return $this->belongsTo(Organization::class);
    // }
    //
}
