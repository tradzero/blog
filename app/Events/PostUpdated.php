<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PostUpdated
{
    use InteractsWithSockets, SerializesModels;

    public $postId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($postId)
    {
        $this->postId = $postId;
    }
}
