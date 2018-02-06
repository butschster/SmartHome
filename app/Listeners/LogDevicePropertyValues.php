<?php

namespace App\Listeners;

use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Events\DevicePropertyChanged;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogDevicePropertyValues
{
    /**
     * @param DevicePropertyChanged $event
     * @throws \App\Exceptions\DevicePropertyNotFoundException
     */
    public function handle(DevicePropertyChanged $event)
    {
        if ($event->property->driver() instanceof DevicePropertyLoggable) {
            $event->property->logValue();
        }
    }
}
