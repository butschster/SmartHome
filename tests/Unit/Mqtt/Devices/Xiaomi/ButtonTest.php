<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Mqtt\Devices\Properties\Action;
use SmartHome\Domain\Mqtt\Devices\Xiaomi\Button;
use Tests\TestCase;

class ButtonTest extends TestCase
{
    function test_properties()
    {
        $device = new Button($this->app);

        $this->assertEquals([
            'action' => Action::class
        ], $device->properties());
    }
}
