<?php

namespace App\Policies;

use App\Comment;

class CommentPolicy extends Policy
{
    public function index(User $user)
    {
    }

    public function show(User $user, Comment $comment)
    {
    }

    public function pass(User $user, Comment $comment)
    {
    }

    public function before($user, $ability)
    {
        parent::before($user, $ability);
        return $this->isAdmin();
    }
}
