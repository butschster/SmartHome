<?php

namespace SmartHome\Domain\Devices\Events\DeviceProperty;

use SmartHome\Domain\Devices\Entities\DeviceProperty;

class Set
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
