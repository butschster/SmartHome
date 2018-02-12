<?php

namespace App\Console\Commands\Mqtt;

use App\Entities\MqttLog;
use Illuminate\Console\Command;

class PruneDatabaseLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:prune-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Удаление устаревших логов из БД';

    /**
     * @throws \Exception
     */
    public function handle()
    {
        MqttLog::where('created_at', '<', now()->subWeek())->delete();
    }
}
