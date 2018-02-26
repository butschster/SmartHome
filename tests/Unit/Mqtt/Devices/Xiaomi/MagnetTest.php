<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\App\Devices\Properties\Door;
use SmartHome\Domain\Xiaomi\Devices\Magnet;
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
