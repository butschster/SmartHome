<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Xiaomi\MiHome\Devices\Magnet;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Door, Battery
};
use Tests\TestCase;

class MagnetTest extends TestCase
{
    function test_properties()
    {
        $device = new Magnet($this->app);

        $this->assertEquals([
            'status' => Door::class,
            'voltage' => Battery::class
        ], $device->properties());
    }
}
