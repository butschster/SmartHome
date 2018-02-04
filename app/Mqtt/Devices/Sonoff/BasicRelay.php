<?php

namespace App\Mqtt\Devices\Sonoff;

use App\Mqtt\Devices\Device;
use App\Mqtt\Devices\Properties\Power;

class BasicRelay extends Device
{
    /**
     * @var array
     */
    protected $allowedProperties = [
        'POWER' => Power::class
    ];
}