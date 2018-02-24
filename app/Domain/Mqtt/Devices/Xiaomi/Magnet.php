<?php

namespace SmartHome\Domain\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Device;
use SmartHome\Domain\Mqtt\Devices\Properties\Door;

class Magnet extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'state' => Door::class
    ];
}