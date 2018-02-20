<?php

namespace Tests\Unit\Device;

use App\Entities\Device;
use Illuminate\Support\Facades\Event;
use Tests\Helpers\TestDevice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceTest extends TestCase
{
    use RefreshDatabase;

    function test_it_should_fire_event_when_device_created()
    {
        Event::fake([\App\Events\Device\Registered::class]);
        $device = $this->createTestDevice();

        Event::assertDispatched(\App\Events\Device\Registered::class, function($e) use($device) {
            return $e->device->id == $device->id;
        });
    }

    function test_gets_device_driver()
    {
        $device = $this->createTestDevice();
        $deviceDriver = $device->driver();

        $this->assertInstanceOf(TestDevice::class, $deviceDriver);
    }

    function test_gets_model_by_key()
    {
        $device = $this->createTestDevice();

        $foundDevice = Device::register($device->key, $device->type);

        $this->assertEquals($device->id, $foundDevice->id);
    }

    function test_creates_device_if_not_exist()
    {
        $this->registerTestDeviceConfig();

        $device = Device::register('test_device', 'test_device');

        $this->assertDatabaseHas((new Device)->getTable(), [
            'id' => $device->id,
            'key' => 'test_device',
            'type' => 'test_device'
        ]);
    }
}