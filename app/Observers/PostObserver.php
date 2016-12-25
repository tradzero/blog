<?php

namespace App\Observers;
use App\Post;
use Cache;

class PostObserver
{
    public function created(Post $post)
    {
        $post->load('tags', 'user', 'comments.user');
        $post->content = app('parsedown')->text($post['content']);
        $postCacher = $post->toArray();
        Cache::tags(['posts', 'comments', 'user'])->put('post:' . $post['id'], $postCacher, 60*24*7);
    }
}