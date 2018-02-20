<?php

namespace App\Mqtt\Devices\Sonoff;

use App\Mqtt\Devices\Device;
use App\Mqtt\Devices\Properties\Power;

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