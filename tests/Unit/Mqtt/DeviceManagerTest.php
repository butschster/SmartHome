<?php

namespace Tests\Unit\Mqtt;

use SmartHome\Domain\Mqtt\Contracts\Device;
use SmartHome\Domain\Mqtt\Devices\Sonoff\BasicRelay;
use Tests\TestCase;
use SmartHome\Domain\Mqtt\Contracts\DeviceManager as DeviceManagerContract;

class DeviceManagerTest extends TestCase
{
    function test_it_has_default_driver()
    {
        $manager = $this->makeManager();

        $this->assertEquals(
            Device::TYPE_SONOFF_BASIC,
            $manager->getDefaultDriver()
        );
    }

    function test_it_can_create_driver_object_for_exists_device()
    {
        $manager = $this->makeManager();

        $this->assertInstanceOf(
            BasicRelay::class,
            $manager->driver(Device::TYPE_SONOFF_BASIC)
        );
    }

    /**
     * @expectedException SmartHome\Domain\Mqtt\Exceptions\DeviceDriverNotFoundException
     */
    function test_it_should_throw_an_exception_if_driver_not_found()
    {
        $manager = $this->makeManager();
        $manager->driver('test');
    }
    
    function test_it_can_register_custom_driver_as_string()
    {
        $manager = $this->makeManager();
        $manager->register('test_driver', BasicRelay::class);

        $this->assertInstanceOf(
            BasicRelay::class,
            $manager->driver('test_driver')
        );
    }

    function test_it_can_register_custom_driver_as_array()
    {
        $manager = $this->makeManager();
        $manager->register('test_driver', [
            'class' => BasicRelay::class
        ]);

        $this->assertInstanceOf(
            BasicRelay::class,
            $manager->driver('test_driver')
        );
    }

    /**
     * @return DeviceManagerContract
     */
    protected function makeManager(): DeviceManagerContract
    {
        return $this->app->make(DeviceManagerContract::class);
    }
}
