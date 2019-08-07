<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Message;
use Illuminate\Auth\Access\HandlesAuthorization;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any messages.
     *
     * @param  User  $user
     * @return bool
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the message.
     *
     * @param  User  $user
     * @param  Message  $message
     * @return bool
     */
    public function view(User $user, Message $message)
    {
        return in_array($user->id, [$message->recipient_id, $message->sender_id]);
    }

    /**
     * Determine whether the user can create messages.
     *
     * @param  User  $user
     * @return bool
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the message.
     *
     * @param  User  $user
     * @param  Message  $message
     * @return bool
     */
    public function update(User $user, Message $message)
    {
        return $user->isAdmin() || in_array($user->id, [$message->recipient_id, $message->sender_id]);
    }

    /**
     * Determine whether the user can delete the message.
     *
     * @param  User  $user
     * @param  Message  $message
     * @return bool
     */
    public function delete(User $user, Message $message)
    {
        return $user->isAdmin() || in_array($user->id, [$message->recipient_id, $message->sender_id]);
    }

    /**
     * Determine whether the user can restore the message.
     *
     * @param  User  $user
     * @param  Message  $message
     * @return bool
     */
    public function restore(User $user, Message $message)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the message.
     *
     * @param  User  $user
     * @param  Message  $message
     * @return bool
     */
    public function forceDelete(User $user, Message $message)
    {
        return $user->isAdmin();
    }
}
