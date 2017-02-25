<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
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

    public function pass($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_deleted = 0;
        $comment->save();
        return Response::json(['data' => 'pass'], 200);
    }

    public function deny($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->is_deleted = 1;
        $comment->save();
        return Response::json(['data' => 'deny'], 200);
    }
}
