<?php

namespace Tests\Unit\Device;

use App\Contracts\Mqtt\Client as MqttClient;
use App\Entities\Device;
use App\Entities\DeviceProperty;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class DevicePropertyTest extends TestCase
{
    use RefreshDatabase;

    function test_it_has_device()
    {
        $property = factory(DeviceProperty::class)->create();

        $this->assertInstanceOf(Device::class, $property->device);
    }
    function test_runs_toggle_command()
    {
        $this->app->instance(MqttClient::class, $client = m::mock(MqttClient::class));

        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => \App\Contracts\Mqtt\Device::TYPE_SONOFF_BASIC
        ]);

        /** @var DeviceProperty $property */
        $property = factory(DeviceProperty::class)->create([
            'device_id' => $device->id,
            'key' => 'POWER'
        ]);

        $client->shouldReceive('publish')->with("cmnd/{$device->key}/$property->key", 1);
        $property->runCommand('toggle');

        $property->value = 1;

        $client->shouldReceive('publish')->with("cmnd/{$device->key}/$property->key", 0);
        $property->runCommand('toggle');
    }

    function test_runs_switchOn_command()
    {
        $this->app->instance(MqttClient::class, $client = m::mock(MqttClient::class));

        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => \App\Contracts\Mqtt\Device::TYPE_SONOFF_BASIC
        ]);

        /** @var DeviceProperty $property */
        $property = factory(DeviceProperty::class)->create([
            'device_id' => $device->id,
            'key' => 'POWER'
        ]);

        $client->shouldReceive('publish')->with("cmnd/{$device->key}/$property->key", 1);
        $property->runCommand('switchOn');
    }

    function test_runs_switchOff_command()
    {
        $this->app->instance(MqttClient::class, $client = m::mock(MqttClient::class));

        /** @var Device $device */
        $device = factory(Device::class)->create([
            'type' => \App\Contracts\Mqtt\Device::TYPE_SONOFF_BASIC
        ]);

        /** @var DeviceProperty $property */
        $property = factory(DeviceProperty::class)->create([
            'device_id' => $device->id,
            'key' => 'POWER'
        ]);

        $client->shouldReceive('publish')->with("cmnd/{$device->key}/$property->key", 0);
        $property->runCommand('switchOff');
    }
}
