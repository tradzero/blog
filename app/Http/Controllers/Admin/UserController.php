<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = $this->getUsersLatestInfoById($id);
        return view('admin.users.profile', compact('user'));
    }

    private function getUsersLatestInfoById($id)
    {
        $user = User::with([
            'posts' => function ($query) {
                $query->orderBy('updated_at', 'desc')->take(5);
            },
            'comments' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(5);
            },
            'comments.post'
        ])->withCount('comments', 'posts')->findOrFail($id);
        return $user;
    }
}
