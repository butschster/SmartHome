<?php

namespace SmartHome\Domain\Devices\Console\Commands;

use SmartHome\Domain\Devices\Entities\DeviceLog;
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
        DeviceLog::newQuery()->where('created_at', '<', now()->subWeek())->forceDelete();

        event(\SmartHome\Domain\Devices\Events\Device\LogsPruned::class);
    }
}
