<?php

namespace SmartHome\Domain\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Device;
use SmartHome\Domain\Mqtt\Devices\Properties\Humidity;
use SmartHome\Domain\Mqtt\Devices\Properties\Temperature;

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