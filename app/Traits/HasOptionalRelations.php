<?php

namespace App\Traits;

trait HasOptionalRelations
{
    public function scopeWithOptionalRelations($query, array $with)
    {
        if (!empty($with)) {
            $query->with($with);
        }
        return $query;
    }
}
