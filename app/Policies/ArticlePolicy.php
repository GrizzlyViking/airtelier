<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class ArticlePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any articles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function view(User $user, Article $article)
    {
        return true;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !Auth::guest();
    }

    /**
     * Author and admin can update.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function update(User $user, Article $article)
    {
        return $article->author_id === $user->id || $user->isAdmin();
    }

    /**
     * Author and admin can delete.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return mixed
     */
    public function delete(User $user, Article $article)
    {
        return $article->author_id === $user->id || $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return bool
     */
    public function restore(User $user, Article $article)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  User  $user
     * @param  Article  $article
     * @return bool
     */
    public function forceDelete(User $user, Article $article)
    {
        return $user->isAdmin();
    }
}
