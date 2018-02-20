<?php

namespace App\Listeners;

use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Events\DeviceProperty\Changed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogDevicePropertyValues
{
    /**
     * @param Changed $event
     * @throws \App\Exceptions\DevicePropertyNotFoundException
     */
    public function handle(Changed $event)
    {
        if ($event->property->driver() instanceof DevicePropertyLoggable) {
            $event->property->logValue();
        }
    }
}
