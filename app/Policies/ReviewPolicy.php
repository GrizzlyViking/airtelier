<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any reviews.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the review.
     *
     * @param  User  $user
     * @param  Review  $review
     * @return mixed
     */
    public function view(User $user, Review $review)
    {
        return true;
    }

    /**
     * Determine whether the user can create reviews.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the review.
     *
     * @param  User  $user
     * @param  Review  $review
     * @return mixed
     */
    public function update(User $user, Review $review)
    {
        return $user->isAdmin() || $user->id === $review->author_id;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  User  $user
     * @param  Review  $review
     * @return mixed
     */
    public function delete(User $user, Review $review)
    {
        return $user->isAdmin() || $user->id === $review->author_id;
    }

    /**
     * Determine whether the user can restore the review.
     *
     * @param  User  $user
     * @param  Review  $review
     * @return mixed
     */
    public function restore(User $user, Review $review)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the review.
     *
     * @param  User  $user
     * @param  Review  $review
     * @return mixed
     */
    public function forceDelete(User $user, Review $review)
    {
        return $user->isAdmin();
    }
}
