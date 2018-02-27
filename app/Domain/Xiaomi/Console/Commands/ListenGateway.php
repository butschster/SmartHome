<?php

namespace SmartHome\Domain\Xiaomi\Console\Commands;

use Illuminate\Console\Command;
use SmartHome\Domain\Xiaomi\Console\Worker;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Hub;

class ListenGateway extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'xiaomi:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listen gateway messages';

    /**
     * @param Hub $hub
     * @throws \SmartHome\Domain\Xiaomi\MiHome\Gateway\Exceptions\SocketConnectionError
     */
    public function handle(Hub $hub)
    {
        $hub->connect($this->output);
        $hub->listenMessages();
    }
}
