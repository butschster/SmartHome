<?php

namespace Tests\Unit\Device;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Event;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Entities\DevicePropertyLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicePropertyLogTest extends TestCase
{
    use RefreshDatabase;

    function test_a_device_property_log_has_link_to_property()
    {
        $log = factory(DevicePropertyLog::class)->create();

        $this->assertInstanceOf(DeviceProperty::class, $log->property);
    }

    function test_a_device_property_has_logs()
    {
        $property = $this->createDeviceProperty();

        $this->assertInstanceOf(Collection::class, $property->logs);
    }

    function test_a_device_property_can_log_value()
    {
        $property = $this->createDeviceProperty();

        $oldValue = $property->value;

        $property->value = 'new';
        $property->logValue();

        $this->assertEquals(1, $property->logs()->count());
        $this->assertEquals($oldValue, $property->logs->first()->value);
    }

    function test_gets_prev_value_for_device_property()
    {
        $property = $this->createDeviceProperty();

        Event::fake();

        $oldValue = $property->value;

        $property->value = 'new';
        $property->logValue();
        $property->save();

        $this->assertEquals('new', $property->value);
        $this->assertEquals($oldValue, $property->prevValue());
        $this->assertEquals($oldValue, $property->prev_value);
    }
}
