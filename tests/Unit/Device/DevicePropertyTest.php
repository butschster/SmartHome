<?php

namespace Tests\Unit\Device;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Entities\DevicePropertyLog;
use SmartHome\Domain\Devices\Events\DeviceProperty\Changed;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicePropertyTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_device()
    {
        $property = $this->createDeviceProperty();

        $this->assertInstanceOf(Device::class, $property->device);
    }

    function test_a_device_has_properties()
    {
        $device = $this->createDevice();

        $this->assertEquals(0, $device->properties()->count());

        $this->createDeviceProperty([
            'device_id' => $device->id
        ], 3);

        $this->assertEquals(3, $device->properties()->count());
    }

    function test_a_device_can_creates_allowed_properties_by_key_value()
    {
        $device = $this->createTestDevice();

        Event::fake([
            Changed::class
        ]);

        $device->setProperties([
            'test' => 'test_value',
            'ignored' => 'test_value1'
        ]);

        Event::assertNotDispatched(Changed::class);

        $this->assertEquals(1, $device->properties()->count());

        $table = (new DeviceProperty())->getTable();
        $this->assertDatabaseHas($table, ['device_id' => $device->id, 'key' => 'test', 'value' => 'test_value']);
        $this->assertDatabaseMissing($table, ['device_id' => $device->id, 'key' => 'ignored', 'value' => 'test_value1']);
    }

    function test_a_device_should_updates_properties_if_they_exists()
    {
        $device = $this->createTestDevice();

        Event::fake([
            Changed::class
        ]);

        $device->setProperties(['test' => 'test_value']);
        $device->setProperties(['test' => 'test_value2']);

        Event::assertDispatched(Changed::class, 1);

        $this->assertEquals(1, $device->properties()->count());

        $table = (new DeviceProperty)->getTable();
        $this->assertDatabaseHas($table, ['device_id' => $device->id, 'key' => 'test', 'value' => 'test_value2']);
    }

    function test_loggable_property_should_log_changed_value()
    {
        $device = $this->createTestDevice();

        $device->setProperties(['loggable' => 'test_value']);
        $device->setProperties(['loggable' => 'test_value2']);

        $logTable = (new DevicePropertyLog())->getTable();
        $this->assertDatabaseHas($logTable, ['device_property_id' => $device->properties->first()->id, 'value' => 'test_value']);
    }

    function test_a_non_loggable_property_shouldnot_log_changed_value()
    {
        $device = $this->createTestDevice();

        $device->setProperties(['test' => 'test_value']);
        $device->setProperties(['test' => 'test_value2']);

        $logTable = (new DevicePropertyLog)->getTable();
        $this->assertDatabaseMissing($logTable, ['device_property_id' => $device->properties->first()->id, 'value' => 'test_value']);
    }
}