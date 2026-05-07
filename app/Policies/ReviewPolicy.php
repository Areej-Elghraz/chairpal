<?php

namespace App\Policies;

use App\Models\User;

class ReviewPolicy
{
    // /**
    //  * Determine whether the user can view any models.
    //  */
    // public function viewAny(User $user): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can view the model.
    //  */
    // public function view(User $user, Place $place): bool
    // {
    //     if ($user->isOrganization()) {
    //         $org = $user->organizationRoleOrganization();
    //         return $org
    //             && $place->owner_id == $user->id
    //             && $place->organization_id == $org->id;
    //     }

    //     return is_null($place->owner_id)
    //         || optional($place->owner)->isOrganization()
    //         || $place->owner_id == $user->id;
    //     // || ($place->owner && $place->owner->role == UserRoleEnum::ORGANIZATION->value);
    // }

    // /**
    //  * Determine whether the user can create models.
    //  */
    // public function create(User $user, array $data): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, array $data): bool
    {
        return $user->isUser();
    }

    // /**
    //  * Determine whether the user can update the model.
    //  */
    // public function update(User $user, Place $place): bool
    // {
    //     return false;
    // }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, \App\Models\Review $review): bool
    {
        if ($user->isUser()) {
            return $review->user_id === $user->id;
        }

        if ($user->isOrganization()) {
            if ($review->reviewable_type === 'App\Models\Organization') {
                return $review->reviewable->owner_id === $user->id;
            }
            if ($review->reviewable_type === 'App\Models\Place') {
                return $review->reviewable->organization?->owner_id === $user->id;
            }
        }

        return false;
    }

    // /**
    //  * Determine whether the user can restore the model.
    //  */
    // public function restore(User $user, Place $place): bool
    // {
    //     return false;
    // }

    // /**
    //  * Determine whether the user can permanently delete the model.
    //  */
    // public function forceDelete(User $user, Place $place): bool
    // {
    //     return false;
    // }
}
