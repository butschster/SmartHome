<?php

namespace SmartHome\App\Devices;

use SmartHome\Domain\Devices\Entities\DeviceProperty;

class Event
{
    /**
     * @var DeviceProperty
     */
    public $property;

    /**
     * @param DeviceProperty $property
     */
    public function __construct(DeviceProperty $property)
    {
        $this->property = $property;
    }
}