<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Action, Battery
};

class Button extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'status' => Action::class,
        'voltage' => Battery::class
    ];
}