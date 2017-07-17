<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::with('posts')->findOrFail($id);
        
        $posts = $user->posts()
            ->exist()
            ->orderBy('created_at', 'desc')
            ->paginate(config('blog.display_item'));
        $posts->load('user');

        return view('user', compact('user', 'posts'));
    }
}
