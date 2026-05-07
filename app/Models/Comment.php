<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'commentable_id', 'commentable_type', 'content', 'parent_id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
