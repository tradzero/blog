<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;
use App\User;

class Policy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    protected function isAdmin()
    {
        $user = Auth::user();
        return $user ?  $user->role == User::ROLE_ADMIN : false;
    }

    public function before($user, $ability)
    {
    }
}
