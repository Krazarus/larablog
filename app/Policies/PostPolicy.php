<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function update(User $user, Post $post)
    {
        return @$post->likes->first()->user_id == $user->id;

    }

    /**
     * @param User $user
     * @param Post $post
     * @return bool
     */
    public function delete(User $user, Post $post)
    {
        return $post->user_id == $user->id;
    }
}
