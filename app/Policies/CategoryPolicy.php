<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Category $category): bool
    {
        // organization role user
        if ($user->isOrganization()) {
            $org = $user->organizationRoleOrganization();
            return $org
                && $category->owner_id == $user->id
                && $category->organizations()
                ->where('organizations.id', $org->id)
                ->exists();
        }

        // normal user role
        return
            // main categories
            // (is_null($category->owner_id) && !$category->organizations()->exists())
            is_null($category->owner_id)

            // categories added by any organization
            // || $category->organizations()->exists()
            || optional($category->owner)->isOrganization()

            // categories added by this user
            || $category->owner_id == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, array $data): bool
    {
        if ($user->isOrganization()) {
            $org = $user->organizationRoleOrganization();
            return $org
                && isset($data['organization_id'])
                && $data['organization_id'] == $org->id;
        }
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        if ($user->isOrganization()) {
            $org = $user->organizationRoleOrganization();
            return $org
                && $category->owner_id == $user->id
                && $category->organizations()
                ->where('organizations.id', $org->id)
                ->exists();
        }
        return $category->owner_id == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $this->update($user, $category);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Category $category): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Category $category): bool
    {
        return false;
    }
}
