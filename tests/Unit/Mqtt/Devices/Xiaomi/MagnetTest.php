<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Properties\Door;
use SmartHome\Domain\Mqtt\Devices\Xiaomi\Magnet;
use Tests\TestCase;

class MagnetTest extends TestCase
{
    function test_properties()
    {
        $device = new Magnet($this->app);

        $this->assertEquals([
            'state' => Door::class
        ], $device->properties());
    }
}
