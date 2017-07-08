<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Post;
use Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function guestLike($type, $behavior, $field, $id)
    {
        if (!Session($field . ':' . $id)) {
            $type->increment($behavior);
            Session([$field . ':' . $id => true]);
            return true;
        }
        return false;
    }

    protected function postCache($postId)
    {
        $post = Post::exist()->with('tags', 'user', 'comments.user')->findOrFail($postId);
        $post->content = app('parsedown')->text($post['content']);
        return $post->toArray();
    }

    protected function updateCache($postId)
    {
        $postData = $this->postCache($postId);
        Cache::tags(['posts', 'comments', 'user'])->put('post:' . $postId, $postData, 60*24*1);
    }
}
