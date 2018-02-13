<?php

namespace App\Observers;

use App\Entities\DeviceProperty;
use App\Events\DevicePropertyChanged;
use Illuminate\Contracts\Events\Dispatcher;

class DevicePropertyChangedObserver
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
     * @param DeviceProperty $property
     */
    public function updating(DeviceProperty $property)
    {
        $this->events->dispatch(new DevicePropertyChanged($property));
    }
}