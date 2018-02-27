<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Battery, Humidity, Temperature
};
use SmartHome\Domain\Xiaomi\MiHome\Devices\Thermometer;
use Tests\TestCase;

class ThermometerTest extends TestCase
{
    function test_properties()
    {
        $device = new Thermometer($this->app);

        $this->assertEquals([
            'temperature' => Temperature::class,
            'humidity' => Humidity::class,
            'voltage' => Battery::class
        ], $device->properties());
    }
}
