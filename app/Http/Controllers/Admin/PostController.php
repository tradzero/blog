<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        return view('admin.posts.index');
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        $post = new Post();
        $parsedown = app('parsedown');
        $post->title = $request->title;
        $post->content = $request->content;
        $post->visible = $request->visible;

        Auth::user()->posts()->save($post);
        return redirect('/admin/posts');
    }

}
