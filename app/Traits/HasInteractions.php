<?php

namespace App\Traits;

use App\Models\Comment;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait HasInteractions
{
    /**
     * Get all of the model's reviews.
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Get all of the model's comments.
     */
    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the users who favorited this model.
     */
    public function favoritedBy(): MorphToMany
    {
        return $this->morphToMany(User::class, 'favoritable', 'favorites', 'favoritable_id', 'user_id')->withTimestamps();
    }

    /**
     * Get all of the users who visited this model.
     */
    public function visitors(): MorphToMany
    {
        return $this->morphToMany(User::class, 'visitable', 'visitors', 'visitable_id', 'user_id')->withTimestamps();
    }

    /**
     * Get the average rating of the model.
     */
    public function getAverageRatingAttribute(): float
    {
        return round($this->reviews()->avg('rating') ?? 0, 1);
    }

    /**
     * Get the total number of visitors.
     */
    public function getVisitorsCountAttribute(): int
    {
        return $this->visitors()->count();
    }
}
