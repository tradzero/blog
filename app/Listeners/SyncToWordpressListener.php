<?php

namespace App\Listeners;

use App\Events\PostCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Tradzero\WPREST\Resources\Post as WPost;
use Tradzero\WPREST\Resources\Category as WCategory;
use WPREST;

class SyncToWordpressListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(PostCreated $event)
    {
        if (config('services.wordpress.sync_wordpress')) {
            $this->syncToWordpress($event);
        }
    }

    protected function syncToWordpress(PostCreated $event)
    {
        $post = $event->post;
        $post->content = app('parsedown')->text($post['content']);

        $categories = [];

        foreach ($post->tags as $tag) {
            $category = new WCategory();
            $category->setName($tag->name);
            $category = WPREST::findCategoryOrCreate($category);

            array_push($categories, $category);
        }
        $wpost = new WPost();
        $wpost->setTitle($post->title);
        $wpost->setContent($post->content);
        $wpost->setCategories($categories);
        
        WPREST::createPost($wpost);
    }
}
