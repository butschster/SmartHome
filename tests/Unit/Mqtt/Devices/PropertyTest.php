<?php

namespace Tests\Unit\Mqtt\Devices;

use App\Mqtt\Devices\Property;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class PropertyTest extends TestCase
{
    use RefreshDatabase;

    function test_sets_device_property()
    {
        $property = $this->makeProperty();

        $this->assertNull(
            $property->setDeviceProperty(
                $this->createDeviceProperty()
            )
        );
    }

    function test_gets_commands()
    {
        $property = $this->makeProperty();

        $this->assertTrue(
            is_array($property->commands())
        );
    }

    function test_gets_meta()
    {
        $property = $this->makeProperty();

        $this->assertTrue(
            is_array($property->meta())
        );
    }

    function test_runs_command()
    {
        $client = m::mock(\App\Contracts\Mqtt\Client::class);
        $property = $this->makeProperty($client);
        $property->setDeviceProperty(
            $deviceProperty = $this->createDeviceProperty([
                'key' => 'test'
            ])
        );

        $message = 'Hello world';

        $client->shouldReceive('publish')->once()->andReturnUsing(function($topic, $m) use($deviceProperty, $message) {
            $this->assertEquals(sprintf(
                'cmnd/%s/%s/%s',
                $deviceProperty->device->type,
                $deviceProperty->device->key,
                $deviceProperty->key
            ), $topic);

            $this->assertEquals($message, $m);
        });


        $property->runCommand($message);
    }

    function test_format_value()
    {
        $property = $this->makeProperty();

        $value = 'test';

        $this->assertEquals($value, $property->format($value));
    }

    /**
     * @param null $client
     * @param null $logger
     * @return Property
     */
    protected function makeProperty($client = null, $logger = null)
    {
        return m::mock(
            Property::class,
            [
                $client ?: m::mock(\App\Contracts\Mqtt\Client::class),
                $logger ?: m::mock(\Psr\Log\LoggerInterface::class)
            ]
        )->makePartial();
    }
}
