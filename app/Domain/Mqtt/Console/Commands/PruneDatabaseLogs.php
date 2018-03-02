<?php

namespace SmartHome\Domain\Mqtt\Console\Commands;

use Illuminate\Console\Command;
use SmartHome\Domain\Mqtt\MqttLog;

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
        (new MqttLog)->newQuery()->where('created_at', '<', now()->subDay())->forceDelete();
    }
}
