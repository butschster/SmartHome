<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Event;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Events\DeviceProperty\CommandRun;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoomTest extends TestCase
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

    function test_room_has_device_properties()
    {
        $room = $this->createRoom();

        $this->assertInstanceOf(Collection::class, $room->deviceProperties);
    }

    function test_device_property_can_be_attached_to_room()
    {
        $room = $this->createRoom();
        $property = $this->createDeviceProperty();

        $room->deviceProperties()->attach($property);

        $this->assertEquals(1, $room->deviceProperties()->count());
    }


    function test_it_can_be_run_commands_in_the_room()
    {
        $room = $this->createRoom();
        $property = $this->makeProperty();
        $propertySecond = $this->makeProperty();
        $propertyThird = $this->createDeviceProperty([
            'key' => 'test'
        ]);

        $room->deviceProperties()->attach($property);
        $room->deviceProperties()->attach($propertySecond);
        $room->deviceProperties()->attach($propertyThird);

        Event::fake();
        $room->runCommand('command');
        Event::assertDispatched(CommandRun::class, 2);
    }
}


class PropertyWithCommands extends \SmartHome\Domain\Mqtt\Devices\Property
{
    /**
     * @var array
     */
    protected $commands = [
        'command'
    ];

    public function transform($value)
    {
        return $value;
    }

    public function command(DeviceProperty $property)
    {

    }
}
