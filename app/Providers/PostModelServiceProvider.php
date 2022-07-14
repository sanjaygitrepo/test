<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class PostModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \App\Models\Post::observe(\App\Observers\PostObserver::class);

    }
}
