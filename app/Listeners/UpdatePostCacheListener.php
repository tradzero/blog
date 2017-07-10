<?php

namespace App\Listeners;

use App\Events\PostUpdated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Post;
use Cache;

class UpdatePostCacheListener
{
    public function handle(PostUpdated $event)
    {
        $postId = $event->postId;
        $post = Post::with('tags', 'user', 'comments.user')->findOrFail($postId);
        $this->updateCache($post);
    }

    protected function updateCache($post)
    {
        $post->content = app('parsedown')->text($post['content']);
        $postData = $post->toArray();
        $postId = $post->id;
        Cache::tags(['posts', 'comments', 'user'])->put('post:' . $postId, $postData, 60*24*1);
    }
}
