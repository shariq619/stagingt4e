<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\GenerateCompletedCertificates::class,
        \App\Console\Commands\CronTest::class,
        \App\Console\Commands\SendCohortTaskReminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('certificates:generate')->everyFifteenMinutes();
        $schedule->command('reminder:cohort-tasks')->dailyAt('09:00');
        $schedule->command('emails:run-time-triggers')->dailyAt('16:25');

        //$schedule->command('test:cron')->everyMinute(); // for quick testing

        //$schedule->job(new \App\Jobs\BackupDatabase)->daily();

        $schedule->call(function () {
            (new \App\Jobs\BackupDatabase())->handle();
        })->weekly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
