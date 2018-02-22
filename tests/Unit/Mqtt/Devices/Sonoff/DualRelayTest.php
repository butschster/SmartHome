<?php

namespace Tests\Unit\Mqtt\Devices\Sonoff;

use App\Mqtt\Devices\Properties\Power;
use App\Mqtt\Devices\Sonoff\DualRelay;
use Tests\TestCase;

class DualRelayTest extends TestCase
{
    function test_properties()
    {
        $device = new DualRelay($this->app);

        $this->assertEquals([
            'POWER' => Power::class,
            'POWER1' => Power::class
        ], $device->properties());
    }
}
