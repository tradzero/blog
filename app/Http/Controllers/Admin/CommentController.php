<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Comment;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('user', 'post')->paginate();
        return view('admin.comments.index', compact('comments'));
    }

    public function show($id)
    {
        $comment = Comment::with('user', 'post')->findOrFail($id);
        return view('admin.comments.show', compact('comment'));
    }
}
