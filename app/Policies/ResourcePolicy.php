<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Resource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any resources.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the resource.
     *
     * @param  User     $user
     * @param  Resource $resource
     *
     * @return mixed
     */
    public function view(User $user, Resource $resource)
    {
        return true;
    }

    /**
     * Determine whether the user can create resources.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the resource.
     *
     * @param  User    $user
     * @param Resource $resource
     *
     * @return mixed
     */
    public function update(User $user, Resource $resource): bool
    {
        return $resource->owner->id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the resource.
     *
     * @param  User    $user
     * @param Resource $resource
     *
     * @return mixed
     */
    public function delete(User $user, Resource $resource)
    {
        return $resource->owner->id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the resource.
     *
     * @param  User     $user
     * @param  Resource $resource
     *
     * @return mixed
     */
    public function restore(User $user, Resource $resource)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the resource.
     *
     * @param User      $user
     * @param  Resource $resource
     *
     * @return mixed
     */
    public function forceDelete(User $user, Resource $resource)
    {
        return $resource->owner->id === $user->id || $user->isAdmin();
    }
}
