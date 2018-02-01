<?php

namespace Tests\Unit\Device;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicePropertyTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_device()
    {
        $property = factory(DeviceProperty::class)->create();

        $this->assertInstanceOf(Device::class, $property->device);
    }
}
