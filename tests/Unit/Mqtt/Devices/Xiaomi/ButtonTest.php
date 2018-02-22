<?php

namespace Tests\Unit\Mqtt\Devices\Xiaomi;

use App\Mqtt\Devices\Properties\Action;
use App\Mqtt\Devices\Xiaomi\Button;
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
