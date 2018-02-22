<?php

namespace Tests\Unit\Mqtt\Devices\Properties;

use App\Mqtt\Devices\Properties\Door;
use Tests\TestCase;

class DoorTest extends TestCase
{
    function test_transform_value()
    {
        $action = $this->makePropertyAction(Door::class);

        $this->assertEquals(Door::STATUS_OPEN, $action->transform('open'));
        $this->assertEquals(Door::STATUS_OPEN, $action->transform('1'));
        $this->assertEquals(Door::STATUS_OPEN, $action->transform(1));

        $this->assertEquals(Door::STATUS_CLOSED, $action->transform('0'));
        $this->assertEquals(Door::STATUS_CLOSED, $action->transform('closed'));
    }

    function test_formats_value()
    {
        $action = $this->makePropertyAction(Door::class);
        $this->assertEquals(trans('device.door.open'), $action->format('open'));
        $this->assertEquals(trans('device.door.closed'), $action->format('closed'));
    }

    function test_it_should_be_loggable()
    {
        $this->assertLoggablePropertyAction(
            $this->makePropertyAction(Door::class)
        );
    }
}
