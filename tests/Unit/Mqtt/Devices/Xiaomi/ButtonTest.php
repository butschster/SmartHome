<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use SmartHome\App\Devices\Properties\Action;
use SmartHome\Domain\Xiaomi\Devices\Button;
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
