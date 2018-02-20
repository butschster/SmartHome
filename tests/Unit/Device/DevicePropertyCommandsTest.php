<?php

namespace Tests\Unit\Device;

use App\Entities\DeviceProperty;
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

        /** @var DeviceProperty $property */
        $property = $device->properties->first();
        return $property;
    }

    function test_a_property_can_have_list_of_commands()
    {
        $property = $this->makeProperty();

        $this->assertEquals([
            'command1' => 'command1',
            'command2' => 'command2'
        ], $property->getCommands());
    }

    function test_a_property_can_invoke_available_command()
    {
        $property = $this->makeProperty();

        $property->runCommand('command1', function($response) use($property) {
            $this->assertEquals($property->id, $response->id);
        });
    }

    /**
     * @expectedException App\Exceptions\DevicePropertyCommandNotFound
     */
    function test_a_property_should_throw_an_exception_when_invoking_non_exists_command()
    {
        $property = $this->makeProperty();

        $property->runCommand('command3');
    }
}


class PropertyWithCommands extends \App\Mqtt\Devices\Property
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