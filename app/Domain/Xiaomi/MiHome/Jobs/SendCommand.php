<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;
use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Hub;
use SmartHome\Domain\Xiaomi\Entities\Gateway;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\Write;

class SendCommand implements ShouldQueue
{
    use Queueable;

    /**
     * @var array
     */
    public $command;

    /**
     * @var string
     */
    public $ip;

    /**
     * @var string
     */
    public $sid;

    /**
     * @var string
     */
    public $model;

    /**
     * @param Command $command
     * @param string $ip
     * @param string $sid
     * @param string $model
     */
    public function __construct(Command $command, string $ip, string $sid, string $model)
    {
        $this->command = $command;
        $this->ip = $ip;
        $this->sid = $sid;
        $this->model = $model;

        $this->onQueue('xiaomi_commands');
    }

    /**
     * @param Hub $hub
     * @throws \SmartHome\Domain\Xiaomi\MiHome\Gateway\Exceptions\SocketConnectionError
     */
    public function handle(Hub $hub)
    {
        $gateway = Gateway::where('ip', $this->ip)->first();

        if ($gateway && $gateway->token) {
            $command = new Write($gateway, $this->sid, $this->model, $this->command);
            $hub->sendCommand($command);
        }
    }
}