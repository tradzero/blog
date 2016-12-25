<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon;
use Qiniu\Auth;

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

        $this->app->bind('qiniuAuth', function ($app) {
            return new Auth(config('services.qiniu.appkey'), config('services.qiniu.secretkey'));
        });
    }
}
