<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use App\Events\PostUpdated;
use App\Events\PostCreated;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        $tagIds = $request->get('tags', []);
        $tags = Tag::whereIn('id', $tagIds)->get();
        
        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->visible = $request->visible;

        Auth::user()->posts()->save($post);
        
        if ($tags) {
            $post->tags()->attach($tagIds);
        }

        event(new PostCreated($post));
        
        return redirect('/admin/posts');
    }
    
    public function edit(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->content;
        $post->visible = $request->visible;
        
        $post->save();

        event(new PostUpdated($post->id));

        return redirect('/admin/posts');
    }

    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = 1;
        $post->save();

        event(new PostUpdated($post->id));

        return redirect('/admin/posts')->with('success', '删除成功');
    }

    public function recovery(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->is_deleted = 0;
        $post->save();

        event(new PostUpdated($post->id));
        
        return redirect('/admin/posts')->with('success', '恢复成功');
    }
}
