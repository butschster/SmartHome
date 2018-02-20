<?php

namespace App\Mqtt\Devices\Xiaomi;

use App\Mqtt\Devices\Device;
use App\Mqtt\Devices\Properties\Humidity;
use App\Mqtt\Devices\Properties\Temperature;

class Thermometer extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'temp' => Temperature::class,
        'humidity' => Humidity::class,
    ];
}