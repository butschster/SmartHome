<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\Domain\Xiaomi\MiHome\Devices\Button;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\Action;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\Battery;
use Tests\TestCase;

class ButtonTest extends TestCase
{
    function test_properties()
    {
        $device = new Button($this->app);

        $this->assertEquals([
            'status' => Action::class,
            'voltage' => Battery::class
        ], $device->properties());
    }
}
