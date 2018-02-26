<?php

namespace Tests\Unit\Mqtt\Devices\Properties;

use SmartHome\App\Devices\Properties\Temperature;
use Tests\TestCase;

class TemperatureTest extends TestCase
{
    function test_transform_value()
    {
        $action = $this->makePropertyAction(Temperature::class);

        $this->assertEquals(1.0, $action->transform(1));
        $this->assertEquals(100.5, $action->transform(100.454));
    }

    function test_formats_value()
    {
        $action = $this->makePropertyAction(Temperature::class);
        $this->assertEquals(1, $action->format(1));
    }

    function test_sets_meta()
    {
        $action = $this->makePropertyAction(Temperature::class);
        $this->assertEquals([
            'units' => '℃'
        ], $action->meta());
    }

    function test_it_should_be_loggable()
    {
        $this->assertLoggablePropertyAction(
            $this->makePropertyAction(Temperature::class)
        );
    }
}
