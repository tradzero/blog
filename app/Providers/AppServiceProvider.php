<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;
use Qiniu\Auth;
use Parsedown;
use App\Post;
use App\Observers\PostObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('zh');

        Post::observe(PostObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(\Faker\Generator::class, function () {
            return \Faker\Factory::create('zh_CN');
        });

        // 七牛授权组件
        $this->app->bind('qiniuAuth', function ($app) {
            return new Auth(config('services.qiniu.appkey'), config('services.qiniu.secretkey'));
        });

        // markdown解析器
        $this->app->bind('parsedown', function ($app) {
            $parsedown = new Parsedown;

            return $parsedown->instance();
        });
    }
}
