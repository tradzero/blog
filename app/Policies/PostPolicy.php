<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        // 认证用户或者管理员可以发帖
        return $user->role == 0 || $user->role == 1;
    }
}
