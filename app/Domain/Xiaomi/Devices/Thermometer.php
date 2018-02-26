<?php

namespace SmartHome\Domain\Xiaomi\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\App\Devices\Properties\Humidity;
use SmartHome\App\Devices\Properties\Temperature;

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