<?php

namespace Tests\Unit\Mqtt;

use SmartHome\Domain\Sonoff\Devices;
use SmartHome\Domain\Sonoff\Devices\BasicRelay;
use Tests\TestCase;
use SmartHome\App\Contracts\DeviceManager as DeviceManagerContract;

class DeviceManagerTest extends TestCase
{
    function test_it_can_create_driver_object_for_exists_device()
    {
        $manager = $this->makeManager();

        $this->assertInstanceOf(
            BasicRelay::class,
            $manager->driver(Devices::TYPE_SONOFF_BASIC)
        );
    }

    /**
     * @expectedException SmartHome\App\Exceptions\DeviceDriverNotFoundException
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
