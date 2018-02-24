<?php

namespace SmartHome\Domain\Mqtt\Devices\Sonoff;

use SmartHome\Domain\Mqtt\Devices\Device;
use SmartHome\Domain\Mqtt\Devices\Properties\Power;

class BasicRelay extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'POWER' => Power::class
    ];
}