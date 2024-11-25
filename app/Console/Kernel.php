<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Schedule the CheckExpiredDocuments command to run daily
        $schedule->command('check:expired-documents')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // Load all commands in the Commands directory
        $this->load(__DIR__.'/Commands');

        // Register additional routes in console.php
        require base_path('routes/console.php');
    }
}
