<?php

namespace Tests\Unit\Device;

use App\Entities\Device;
use App\Entities\DeviceLog;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicelLogTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_device()
    {
        $log = factory(DeviceLog::class)->create();

        $this->assertInstanceOf(Device::class, $log->device);
    }
}
