<?php

namespace App\Console;

use App\Jobs\NotifyClientsBeforeTimetableStartsJob;
use App\Jobs\SwitchResourceAvailabilityJob;
use App\Jobs\TimetableHasEndedJob;
use App\Jobs\TimetableHasStartedJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->job(new TimetableHasStartedJob)
            ->weekdays()
            ->between('7:00', '22:00')
            ->hourly();
        $schedule->job(new TimetableHasEndedJob)
            ->weekdays()
            ->between('7:00', '22:00')
            ->hourly();
        $schedule->job(new SwitchResourceAvailabilityJob)
            ->withoutOverlapping()
            ->between('7:00', '22:00')
            ->everyMinute();
        $schedule->job(new NotifyClientsBeforeTimetableStartsJob)
            ->weekdays()
            ->mondays()
            ->wednesdays()
            ->fridays()
            ->at('8:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
