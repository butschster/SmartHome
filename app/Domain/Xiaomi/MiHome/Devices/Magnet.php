<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Battery, Door
};

class Magnet extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'status' => Door::class,
        'voltage' => Battery::class
    ];
}