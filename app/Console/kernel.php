<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\Expiration;
class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Here you can define your scheduled tasks
        // Example: Run a custom command daily
        $schedule->command('user:expire')->everyMinute();
        $schedule->command('user:notify')->everySecond();
        
        // Laravel can notify you when a scheduled task fails or runs too long by sending notifications via Slack, email,
        //  or any supported notification channels. Here’s an example:
    
        // ->onFailure(function () {
        //     // Handle failure, maybe send an email or Slack notification
        // });
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }


    protected $commands = [
    
        \App\Console\Commands\Expiration::class,
        
    ];
}
