<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ViewEvent' => [
            'App\Listeners\VisitEventListener',
        ],

        'App\Events\PostUpdated' => [
            'App\Listeners\UpdatePostCacheListener',
        ],

        'App\Events\PostCreated' => [
            'App\Listeners\CreatePostCacheListener',
            'App\Listeners\SyncToWordpressListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
