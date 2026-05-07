<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d M Y - h:i A');
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function places(): HasMany
    {
        return $this->hasMany(Place::class);
    }
}
