<?php

namespace Tests\Unit\Mqtt\Devices\Sonoff;

use SmartHome\Domain\Sonoff\Devices\BasicRelay;
use SmartHome\Domain\Sonoff\Devices\Properties\Power;
use Tests\TestCase;

class BasicRelayTest extends TestCase
{
    function test_properties()
    {
        $device = new BasicRelay($this->app);

        $this->assertEquals([
            'POWER' => Power::class
        ], $device->properties());
    }
}
