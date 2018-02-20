<?php

namespace Tests\Unit\Mqtt\Device;

use App\Mqtt\Devices\Device;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class DeviceTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_allowed_properties()
    {
        $device = $this->makeDevice();
        $this->assertTrue(is_array($device->properties()));
    }

    /**
     * @return Device
     */
    protected function makeDevice(): Device
    {
        return m::mock(Device::class)->makePartial();
    }
}