<?php

namespace SmartHome\Domain\Mqtt\Devices\Sonoff;

use SmartHome\Domain\Mqtt\Devices\Device;
use SmartHome\Domain\Mqtt\Devices\Properties\Power;

class DualRelay extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'POWER' => Power::class,
        'POWER1' => Power::class,
    ];

}