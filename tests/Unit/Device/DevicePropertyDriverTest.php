<?php

namespace Tests\Unit\Device;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicePropertyDriverTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_property_driver_class()
    {
        $property = $this->createDeviceProperty([
            'key' => 'test'
        ]);

        $propertySecond = $this->createDeviceProperty([
            'key' => 'loggable'
        ]);

        $this->assertEquals(\Tests\Helpers\TestProperty::class, $property->driverClass());
        $this->assertEquals(\Tests\Helpers\TestLoggableProperty::class, $propertySecond->driverClass());
    }

    function test_gets_property_driver_object()
    {
        $property = $this->createDeviceProperty([
            'key' => 'test'
        ]);


        $this->assertInstanceOf(\Tests\Helpers\TestProperty::class, $property->driver());
    }
}
