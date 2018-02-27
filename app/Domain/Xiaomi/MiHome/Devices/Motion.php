<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Battery, Motion as MotionProperty
};

class Motion extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'status' => MotionProperty::class,
        'voltage' => Battery::class
    ];
}