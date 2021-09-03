<?php

namespace App\Console;

use App\Console\Commands\DailyAccrual;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\StoreTokenHistory;

class Kernel extends ConsoleKernel
{
    /** @inheritDoc */
    protected $commands = [
        Commands\DailyAccrual::class,
        Commands\StoreTokenHistory::class,
    ];

    /**
     * @inheritDoc
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command(DailyAccrual::class)->dailyAt('00:01');
        $schedule->command(StoreTokenHistory::class)->everyFifteenMinutes();
    }

    /**
     * @inheritDoc
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
