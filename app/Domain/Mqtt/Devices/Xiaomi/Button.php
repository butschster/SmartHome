<?php

namespace SmartHome\Domain\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Device;
use SmartHome\Domain\Mqtt\Devices\Properties\Action;

class Button extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'action' => Action::class
    ];
}