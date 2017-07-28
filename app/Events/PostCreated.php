<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Post;

class PostCreated
{
    use InteractsWithSockets, SerializesModels;

    public $post;

    public function __construct(Post $post)
    {
        $post = Post::find($post->id);
        
        $post->load('tags', 'user', 'comments.user');

        $this->post = $post;
    }
}
