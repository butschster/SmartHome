<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Properties\Humidity;
use SmartHome\Domain\Mqtt\Devices\Properties\Temperature;
use SmartHome\Domain\Mqtt\Devices\Xiaomi\Thermometer;
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
