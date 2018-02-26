<?php

namespace SmartHome\Domain\Xiaomi\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\App\Devices\Properties\Door;

class Magnet extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'state' => Door::class
    ];
}