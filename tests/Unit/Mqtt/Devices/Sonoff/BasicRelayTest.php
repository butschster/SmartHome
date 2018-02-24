<?php

namespace Tests\Unit\Mqtt\Devices\Sonoff;

use SmartHome\Domain\Mqtt\Devices\Properties\Power;
use SmartHome\Domain\Mqtt\Devices\Sonoff\BasicRelay;
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
