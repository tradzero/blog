<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Cache;

class CreatePostCacheListener
{
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostCreated  $event
     * @return void
     */
    public function handle(PostCreated $event)
    {
        $post = $event->post;

        $post->content = app('parsedown')->text($post['content']);

        $postCacher = $post->toArray();
        
        Cache::tags(['posts', 'comments', 'user'])->put('post:' . $post['id'], $postCacher, 60*24*7);
    }
}
