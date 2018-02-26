<?php

namespace Tests\Unit\Mqtt\Devices\Properties;

use SmartHome\App\Devices\Properties\Action;
use Tests\TestCase;

class ActionTest extends TestCase
{
    function test_transform_value()
    {
        $action = $this->makePropertyAction(Action::class);
        $this->assertEquals('value', $action->transform('value'));
    }

    function test_formats_value()
    {
        $action = $this->makePropertyAction(Action::class);
        $this->assertEquals(trans('device.action.value'), $action->format('value'));
    }

    function test_it_should_be_loggable()
    {
        $this->assertLoggablePropertyAction(
            $this->makePropertyAction(Action::class)
        );
    }
}
