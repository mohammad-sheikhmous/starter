<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Event\YoutubeEvent;
use App\Listener\YoutubeListener;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            YoutubeEvent::class,
            YoutubeListener::class,
        );
    }
}
