<?php

namespace Tests\Unit\Device;

use App\Contracts\Mqtt\Device as DeviceContract;
use App\Entities\Device;
use App\Entities\DeviceLog;
use App\Entities\DeviceProperty;
use App\Mqtt\Devices\Sonoff\BasicRelay;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Contracts\Mqtt\DeviceManager as DeviceManagerContract;

class DeviceTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_logs()
    {
        $device = factory(Device::class)->create();

        factory(DeviceLog::class, 3)->create([
            'device_id' => $device->id
        ]);

        $this->assertInstanceOf(Collection::class, $device->logs);
        $this->assertCount(3, $device->logs);
    }

    function test_creates_logs()
    {
        $device = factory(Device::class)->create();
        $this->assertEquals(0, $device->logs()->count());

        $device->log('Test message');
        $this->assertEquals(1, $device->logs()->count());

        $this->assertDatabaseHas((new DeviceLog)->getTable(), [
            'device_id' => $device->id,
            'message' => 'Test message',
        ]);
    }

    function test_it_has_properties()
    {
        $device = factory(Device::class)->create();

        $this->assertEquals(0, $device->properties()->count());

        factory(DeviceProperty::class, 3)->create([
            'device_id' => $device->id
        ]);

        $this->assertEquals(3, $device->properties()->count());
    }

    function test_creates_properties()
    {
        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => \App\Contracts\Mqtt\Device::TYPE_SONOFF_BASIC
        ]);

        $device->setProperties([
            'POWER' => 'on',
        ]);

        $this->assertEquals(1, $device->properties()->count());

        $this->assertDatabaseHas((new DeviceProperty)->getTable(), [
            'device_id' => $device->id,
            'key' => 'POWER',
            'value' => 1
        ]);
    }

    function test_updates_properties()
    {
        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => \App\Contracts\Mqtt\Device::TYPE_SONOFF_BASIC
        ]);

        $device->setProperties([
            'POWER' => 'value',
        ]);

        $device->setProperties([
            'POWER' => 1,
        ]);

        $this->assertEquals(1, $device->properties()->count());

        $this->assertDatabaseHas((new DeviceProperty)->getTable(), [
            'device_id' => $device->id,
            'key' => 'POWER',
            'value' => 1
        ]);
    }

    function test_gets_device_driver()
    {
        $manager = $this->app->make(DeviceManagerContract::class);
        $manager->register('test_type', TestType::class);

        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => 'test_type'
        ]);

        $deviceDriver = $device->driver();

        $this->assertInstanceOf(TestType::class, $deviceDriver);
        $this->assertEquals($device->key, $deviceDriver->getId());
    }

    function test_gets_model_by_key()
    {
        $device = factory(Device::class)->create();

        $foundDevice = Device::register($device->key, $device->type);

        $this->assertEquals($device->id, $foundDevice->id);
    }

    function test_creates_device_if_not_exist()
    {
        $device = Device::register('test_device', DeviceContract::TYPE_SONOFF_BASIC);

        $this->assertDatabaseHas((new Device)->getTable(), [
            'id' => $device->id,
            'key' => 'test_device',
            'type' => DeviceContract::TYPE_SONOFF_BASIC
        ]);
    }
}

class TestType extends \App\Mqtt\Devices\Device {}