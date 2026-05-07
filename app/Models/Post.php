<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'images',
        'files',
        'shared_post_id'
    ];

    protected $casts = [
        'images' => 'array',
        'files'  => 'array',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sharedPost()
    {
        return $this->belongsTo(Post::class, 'shared_post_id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function sharedPosts()
    {
        return $this->hasMany(Post::class, 'shared_post_id');
    }

    public function hiddenBy()
    {
        return $this->belongsToMany(User::class, 'hidden_posts')->withTimestamps();
    }
}
