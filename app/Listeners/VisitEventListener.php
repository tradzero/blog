<?php

namespace App\Listeners;

use App\Events\ViewEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Redis;

class VisitEventListener
{
    /**
     * Handle the event.
     *
     * @param  ViewEvent  $event
     * @return void
     */
    public function handle(ViewEvent $event)
    {
        $postId = $event->post->id;
        Redis::zincrby('postViewCount' , 1 , 'post:' . $postId);       
    }
}
