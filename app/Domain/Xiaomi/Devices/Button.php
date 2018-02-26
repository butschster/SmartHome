<?php

namespace SmartHome\Domain\Xiaomi\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\App\Devices\Properties\Action;

class Button extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'action' => Action::class
    ];
}