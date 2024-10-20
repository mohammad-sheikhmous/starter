<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Events\YoutubeEvent;
use App\Listeners\YoutubeListener;
use Illuminate\Support\Facades\Event;

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
