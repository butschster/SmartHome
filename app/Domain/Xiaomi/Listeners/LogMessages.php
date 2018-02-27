<?php

namespace SmartHome\Domain\Xiaomi\Listeners;

use SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\GatewayLight;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\Write;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Events\Looping;

class LogMessages
{
    /**
     * @param Looping $message
     * @throws \SmartHome\Domain\Xiaomi\MiHome\Gateway\Exceptions\SocketConnectionError
     */
    public function handle(Looping $message)
    {
        $message->hub->sendCommand(
            new Write('7811dcb2640b', new GatewayLight(1694367256, 1000))
        );
    }
}