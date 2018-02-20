<?php

namespace Tests\Unit\Device;

use App\Entities\Device;
use Tests\Helpers\TestDevice;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_device_driver()
    {
        $device = $this->createTestDevice();
        $deviceDriver = $device->driver();

        $this->assertInstanceOf(TestDevice::class, $deviceDriver);
        $this->assertEquals($device->key, $deviceDriver->getId());
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