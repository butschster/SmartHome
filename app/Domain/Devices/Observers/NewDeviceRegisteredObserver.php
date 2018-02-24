<?php

namespace SmartHome\Domain\Devices\Observers;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Events\Device\Registered as DeviceRegistered;
use Illuminate\Contracts\Events\Dispatcher;

class NewDeviceRegisteredObserver
{
    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * @param Device $device
     */
    public function created(Device $device)
    {
        $this->events->dispatch(
            new DeviceRegistered($device)
        );
    }
}