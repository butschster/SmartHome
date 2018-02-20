<?php

namespace Tests\Unit\Device;

use App\Entities\Device;
use App\Entities\DeviceLog;
use Illuminate\Support\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicelLogTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_device()
    {
        $log = $this->createDeviceLog();

        $this->assertInstanceOf(Device::class, $log->device);
    }

    function test_a_device_has_logs()
    {
        $device = $this->createDevice();

        $this->assertInstanceOf(Collection::class, $device->logs);
        $this->assertEquals(0, $device->logs()->count());

        $this->createDeviceLog([
            'device_id' => $device->id
        ], 3);

        $this->assertEquals(3, $device->logs()->count());
    }

    function test_a_device_can_creates_logs()
    {
        $device = $this->createDevice();
        $this->assertEquals(0, $device->logs()->count());

        $device->log('Test message');
        $this->assertEquals(1, $device->logs()->count());

        $this->assertDatabaseHas((new DeviceLog)->getTable(), [
            'device_id' => $device->id,
            'message' => 'Test message',
        ]);
    }
}
