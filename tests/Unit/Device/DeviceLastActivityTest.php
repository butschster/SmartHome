<?php

namespace Tests\Unit\Device;

use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeviceLastActivityTest extends TestCase
{
    use RefreshDatabase;

    function test_gets_formatted_device_last_activity_property()
    {
        $date = now();
        $device = $this->createDevice([
            'last_activity' => $date
        ]);

        $this->assertEquals($date->toDateTimeString(), $device->formatted_last_activity);
        $this->assertEquals($date->toDateTimeString(), $device->getFormattedLastActivityAttribute());
    }

    function test_update_device_last_activity()
    {
        $device = $this->createDevice([
            'last_activity' => now()->subHour()
        ]);

        $lastActivity = $device->last_activity;

        Event::fake();

        $device->updateLastActivity();

        Event::assertDispatched(\App\Events\Device\LastActivityUpdated::class, function ($e) use ($device) {
            return $e->device->id === $device->id;
        });

        $this->assertTrue($lastActivity->lt($device->last_activity));
    }
}
