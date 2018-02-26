<?php

namespace Tests\Unit\Device;

use Illuminate\Support\Facades\Event;
use SmartHome\app\Devices\Property;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DevicePropertyCommandsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return DeviceProperty
     */
    protected function makeProperty(): DeviceProperty
    {
        $device = $this->createTestDevice();

        $device->driver()->registerProperty('with_commands', PropertyWithCommands::class);

        $device->setProperties([
            'with_commands' => 'value'
        ]);

        return $device->properties->first();
    }

    function test_a_property_can_have_list_of_commands()
    {
        $property = $this->makeProperty();

        $this->assertEquals([
            'command1' => 'command1',
            'command2' => 'command2'
        ], $property->commands());
    }

    function test_a_property_can_invoke_available_command()
    {
        $property = $this->makeProperty();

        Event::fake();

        $property->runCommand('command1', function($response) use($property) {
            $this->assertEquals($property->id, $response->id);
        });

        Event::assertDispatched(\SmartHome\Domain\Devices\Events\DeviceProperty\CommandRun::class, function ($e) use($property) {
            $this->assertEquals($e->command, 'command1');

            return $e->property->id == $property->id;
        });
    }

    /**
     * @expectedException SmartHome\Domain\Devices\Exceptions\DevicePropertyCommandNotFound
     */
    function test_a_property_should_throw_an_exception_when_invoking_non_exists_command()
    {
        $property = $this->makeProperty();

        Event::fake();

        $property->runCommand('command3', function($response) use($property) {
            $this->assertEquals($property->id, $response->id);
        });

        Event::assertNotDispatched(\SmartHome\Domain\Devices\Events\DeviceProperty\CommandRun::class);
    }
}


class PropertyWithCommands extends Property
{
    /**
     * @var array
     */
    protected $commands = [
        'command1',
        'command2'
    ];

    public function transform($value)
    {
        return $value;
    }

    public function command1(DeviceProperty $property, \Closure $closure)
    {
        $closure($property);
    }
}