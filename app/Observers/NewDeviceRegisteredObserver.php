<?php

namespace App\Observers;

use App\Entities\Device;
use App\Events\DeviceRegistered;
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
        $this->events->dispatch(new DeviceRegistered($device));
    }
}