<?php

namespace SmartHome\Domain\Xiaomi\Console\Commands;

use Illuminate\Console\Command;
use SmartHome\Domain\Xiaomi\Entities\XiaomiLog;

class PruneDatabaseLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xiaomi:prune-logs';

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
        XiaomiLog::where('created_at', '<', now()->subDay())->delete();
    }
}
