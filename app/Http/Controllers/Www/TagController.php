<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function show(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);
        $indexPosts = $tag->posts()->where('is_deleted', 0)->with('user')->orderBy('created_at', 'desc')->paginate(5);
        return view('welcome', compact('indexPosts'));
    }
}
