<?php

namespace App\Http\Controllers\Www;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Cache;
use Log;
use App\Post;
use App\Events\ViewEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $indexPosts = Post::exist()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(config('blog.display_item'));
        
        $indexPosts->each(function ($post) {
            $post->content = strip_tags($post->content);
            $post->content = str_limit($post->content, config('blog.preview_length'));
            $post->content = app('parsedown')->text($post->content);
            $post->content = strip_tags($post->content);
        });
        return view('welcome', compact('indexPosts'));
    }
    
    public function like(Request $request, $id)
    {
        // TODO 重构
        $resultData = Collect(['result' => false]);
        $post = Post::exist()->findOrFail($id);
        $type = (boolean)$request->type ? 'unlike' : 'like';
        
        $resultData['result'] = $this->guestLike($post, $type, 'post', $id);
        $this->updateCache($id);
        $resultData['like'] = $post->like;
        $resultData['unlike'] = $post->unlike;
        return $resultData->toJson();
    }

    public function show($id)
    {
        $post = Cache::tags(['posts', 'comments', 'user'])->remember('post:' . $id, 60*24*1, function () use ($id) {
            Log::debug('cache failed, try to find post ' . $id);
            return $this->postCache($id);
        });
        
        // 添加对被删除的文章的过滤
        if ($post['is_deleted'] || !$this->checkVisible($post)) {
            throw new NotFoundHttpException;
        }

        event(new ViewEvent($post['id']));
        
        return view('post', compact('post'));
    }

    protected function checkVisible($post)
    {
        $userId = Auth::id();
        $postVisible = $post['visible'];

        // 当postVisible 为1 时检查用户是否登录 为2时 检查用户id是否与发帖id相等
        if ($postVisible) {
            return $postVisible == 2 ?
                $post['user_id'] == $userId :
                (Boolean)$userId;
        } else {
            return true;
        }
    }
}
