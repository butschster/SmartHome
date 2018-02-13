<?php

namespace App\Console\Commands\Device;

use App\Entities\DeviceLog;
use Illuminate\Console\Command;

class PruneDatabaseLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'device:prune-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление устаревших логов устройств из БД';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        DeviceLog::where('created_at', '<', now()->subWeek())->delete();
    }
}
