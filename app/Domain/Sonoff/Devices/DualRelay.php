<?php

namespace SmartHome\Domain\Sonoff\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Sonoff\Devices\Properties\Power;

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