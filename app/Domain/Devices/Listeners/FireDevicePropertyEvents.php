<?php

namespace SmartHome\Domain\Devices\Listeners;

use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\Domain\Devices\Events\DeviceProperty\Set;

class FireDevicePropertyEvents
{
    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * @param Set $event
     * @throws \SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException
     */
    public function handle(Set $event)
    {
        if ($driver = $event->property->driver()) {
            if ($eventClass = $driver->event()) {
                $this->events->dispatch(
                    new $eventClass($event->property)
                );
            }
        }
    }
}
