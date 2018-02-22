<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use App\Mqtt\Devices\Properties\Door;
use App\Mqtt\Devices\Xiaomi\Magnet;
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
