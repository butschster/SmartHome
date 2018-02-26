<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\App\Devices\Properties\{
    Humidity, Temperature
};
use SmartHome\Domain\Xiaomi\Devices\Thermometer;
use Tests\TestCase;

class ThermometerTest extends TestCase
{
    function test_properties()
    {
        $device = new Thermometer($this->app);

        $this->assertEquals([
            'temp' => Temperature::class,
            'humidity' => Humidity::class,
        ], $device->properties());
    }
}
