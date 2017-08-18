<?php

namespace App\Policies;

use App\User;
use App\Post;

class PostPolicy extends Policy
{
    public function adminIndex(User $user)
    {
        return true;
    }

    public function adminCreate(User $user)
    {
        return $this->authenticated($user);
    }

    public function adminStore(User $user)
    {
        return $this->authenticated($user);
    }

    public function adminEdit(User $user, Post $post)
    {
        return $this->canUpdate($user, $post);
    }

    public function adminUpdate(User $user, Post $post)
    {
        return $this->canUpdate($user, $post);
    }

    public function adminDestroy(User $user, Post $post)
    {
        return $this->canUpdate($user, $post);
    }

    public function adminRecovery()
    {
        return $this->canUpdate($user, $post);
    }

    private function authenticated(User $user)
    {
        return $user->role == User::ROLE_ADMIN || $user->role == User::ROLE_USER;
    }

    private function canUpdate(User $user, Post $post)
    {
        if ($this->isAdmin()) {
            return true;
        } else {
            return $post->user_id == $user->id;
        }
    }
}
