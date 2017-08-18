<?php

namespace App\Policies;

use App\Tag;
use App\User;

class TagPolicy extends Policy
{
    public function index(User $user)
    {
        return $user->role == User::ROLE_ADMIN || $user->role == User::ROLE_USER;
    }

    public function create(User $user)
    {
        // 认证用户或者管理员可以添加Tag
        return $user->role == User::ROLE_ADMIN || $user->role == User::ROLE_USER;
    }

    public function store(User $user)
    {
        return $user->role == User::ROLE_ADMIN || $user->role == User::ROLE_USER;
    }

    public function edit(User $user, Tag $tag)
    {
        // 编辑只允许管理员编辑
        return $this->isAdmin();
    }

    public function update(User $user, Tag $tag)
    {
        return $this->isAdmin();
    }
}
