<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Battery, Humidity, Temperature
};

class Thermometer extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'temperature' => Temperature::class,
        'humidity' => Humidity::class,
        'voltage' => Battery::class
    ];
}