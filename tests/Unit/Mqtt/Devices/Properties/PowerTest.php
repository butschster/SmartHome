<?php

namespace Tests\Unit\Mqtt\Devices\Properties;

use App\Contracts\Mqtt\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Psr\Log\LoggerInterface;
use Mockery as m;
use App\Mqtt\Devices\Properties\Power;
use Tests\TestCase;

class PowerTest extends TestCase
{
    use RefreshDatabase;

    function test_transform_value()
    {
        $action = $this->makePropertyAction(Power::class);

        $this->assertEquals(Power::STATUS_ON, $action->transform(1));
        $this->assertEquals(Power::STATUS_ON, $action->transform('on'));
        $this->assertEquals(Power::STATUS_ON, $action->transform('yes'));
        $this->assertEquals(Power::STATUS_ON, $action->transform(true));
        $this->assertEquals(Power::STATUS_ON, $action->transform('true'));

        $this->assertEquals(Power::STATUS_OFF, $action->transform(false));
        $this->assertEquals(Power::STATUS_OFF, $action->transform(0));
        $this->assertEquals(Power::STATUS_OFF, $action->transform('off'));
    }

    function test_formats_value()
    {
        $action = $this->makePropertyAction(Power::class);
        $this->assertEquals(trans('device.power.1'), $action->format(Power::STATUS_ON));
        $this->assertEquals(trans('device.power.0'), $action->format(Power::STATUS_OFF));
    }

    function test_it_should_be_switchable()
    {
        $this->assertSwitchablePropertyAction(
            $this->makePropertyAction(Power::class)
        );
    }

    function test_it_can_be_switched_on()
    {
        $action = $this->makePropertyAction(
            Power::class,
            $client = m::mock(Client::class),
            $logger = m::mock(LoggerInterface::class)
        );

        $property = $this->createDeviceProperty();
        $action->setDeviceProperty($property);
        $client->shouldReceive('publish')->once()->with('cmnd/'.$property->device->type.'/'.$property->device->key.'/'.$property->key, 1);
        $logger->shouldReceive('debug')->once();

        $action->switchOn($property);
    }

    function test_it_can_be_switched_off()
    {
        $action = $this->makePropertyAction(
            Power::class,
            $client = m::mock(Client::class),
            $logger = m::mock(LoggerInterface::class)
        );

        $property = $this->createDeviceProperty();
        $action->setDeviceProperty($property);
        $client->shouldReceive('publish')->once()->with('cmnd/'.$property->device->type.'/'.$property->device->key.'/'.$property->key, 0);
        $logger->shouldReceive('debug')->once();

        $action->switchOff($property);
    }
}
