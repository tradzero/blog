<?php

namespace App\Policies;

use App\User;

class UserPolicy extends Policy
{
    public function index(User $user)
    {
        return $this->isAdmin();
    }

    public function create(User $user)
    {
        return $this->isAdmin();
    }

    public function store(User $currentUser, User $targetUser)
    {
        return $this->isAdmin();
    }

    public function show(User $currentUser, User $targetUser)
    {
        return $this->isAdmin() ? : $currentUser->id == $targetUser->id;
    }

    public function edit(User $currentUser, User $targetUser)
    {
        return $this->isAdmin();
    }

    public function update(User $currentUser, User $targetUser)
    {
        return $this->isAdmin();
    }
}
