<?php

namespace App\Observers;

use App\Post;
use Cache;

class PostObserver
{
    public function created(Post $post)
    {
        // TODO 封装成独立的方法或者什么然后可以在各种操作调用
        $post->load('tags', 'user', 'comments.user');
        $post->content = app('parsedown')->text($post['content']);
        // TODO remove hardcode
        $post->like = 0;
        $post->unlike = 0;
        $postCacher = $post->toArray();
        Cache::tags(['posts', 'comments', 'user'])->put('post:' . $post['id'], $postCacher, 60*24*7);
    }
}
