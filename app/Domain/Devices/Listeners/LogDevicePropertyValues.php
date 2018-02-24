<?php

namespace SmartHome\Domain\Devices\Listeners;

use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;
use SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException;
use SmartHome\Domain\Devices\Events\DeviceProperty\Changed;

class LogDevicePropertyValues
{
    /**
     * @param Changed $event
     * @throws DevicePropertyNotFoundException
     */
    public function handle(Changed $event)
    {
        if ($event->property->driver() instanceof DevicePropertyLoggable) {
            $event->property->logValue();
        }
    }
}
