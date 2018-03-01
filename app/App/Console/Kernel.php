<?php

namespace SmartHome\App\Console;

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
        \SmartHome\Domain\Weather\Console\Commands\SyncWeather::class,
        \SmartHome\Domain\Devices\Console\Commands\PruneDatabaseLogs::class,
        \SmartHome\Domain\Mqtt\Console\Commands\PruneDatabaseLogs::class,
        \SmartHome\Domain\Mqtt\Console\Commands\Listener::class,
        \SmartHome\Domain\Xiaomi\Console\Commands\ListenGateway::class,
        \SmartHome\Domain\Xiaomi\Console\Commands\PruneDatabaseLogs::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('weather:sync')->everyThirtyMinutes();
        $schedule->command('mqtt:prune-logs')->daily();
        $schedule->command('device:prune-logs')->daily();
        $schedule->command('xiaomi:prune-logs')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
