<?php

namespace Tests\Unit\Mqtt\Devices\Sonoff;

use SmartHome\Domain\Sonoff\Devices\DualRelay;
use SmartHome\Domain\Sonoff\Devices\Properties\Power;
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
