<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Post;
use App\Tag;
use App\User;
use App\Events\PostUpdated;
use App\Events\PostCreated;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        $this->authorize('adminIndex', Post::class);

        $user = Auth::user();

        if ($user->role == User::ROLE_ADMIN) {
            $posts = Post::orderBy('updated_at', 'desc')->paginate(15);
        } else {
            $posts = Post::where('user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(15);
        }

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $this->authorize('adminCreate', Post::class);

        return view('admin.posts.create');
    }

    public function store(PostRequest $request)
    {
        $this->authorize('adminStore', Post::class);

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

        $this->authorize('adminEdit', $post);

        return view('admin.posts.edit', compact('post'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('adminUpdate', $post);

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

        $this->authorize('adminDestroy', $post);

        $post->is_deleted = 1;
        $post->save();

        event(new PostUpdated($post->id));

        return redirect('/admin/posts')->with('success', '删除成功');
    }

    public function recovery(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('adminRecovery', $post);
        
        $post->is_deleted = 0;
        $post->save();

        event(new PostUpdated($post->id));
        
        return redirect('/admin/posts')->with('success', '恢复成功');
    }
}
