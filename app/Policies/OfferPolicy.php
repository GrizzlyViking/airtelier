<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Offer;
use Illuminate\Auth\Access\HandlesAuthorization;

class OfferPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any offers.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the offer.
     *
     * @param  User  $user
     * @param  Offer  $offer
     * @return mixed
     */
    public function view(User $user, Offer $offer)
    {
        return true;
    }

    /**
     * Determine whether the user can create offers.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the offer.
     *
     * @param  User  $user
     * @param  Offer  $offer
     * @return mixed
     */
    public function update(User $user, Offer $offer): bool
    {
        return $offer->owner->id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the offer.
     *
     * @param  User  $user
     * @param  Offer  $offer
     * @return mixed
     */
    public function delete(User $user, Offer $offer)
    {
        return $offer->owner->id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the offer.
     *
     * @param  User  $user
     * @param  Offer  $offer
     * @return mixed
     */
    public function restore(User $user, Offer $offer)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the offer.
     *
     * @param  User  $user
     * @param  Offer  $offer
     * @return mixed
     */
    public function forceDelete(User $user, Offer $offer)
    {
        return $offer->owner->id === $user->id || $user->isAdmin();
    }
}
