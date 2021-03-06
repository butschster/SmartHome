<?php

namespace Tests\Helpers;

use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;
use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Entities\DeviceLog;
use SmartHome\Domain\Devices\Entities\DeviceProperty;

trait DeviceTrait
{
    /**
     * Create a new device
     *
     * @param array $attributes
     * @param int $times
     * @return Device
     */
    public function createDevice(array $attributes = [], int $times = null)
    {
        return factory(Device::class, $times)->create($attributes);
    }

    /**
     * Create a new device with test type
     *
     * @param array $attributes
     * @return Device
     */
    public function createTestDevice(array $attributes = [])
    {
        return $this->createDevice($attributes);
    }

    /**
     * Create a new device property
     *
     * @param array $attributes
     * @param int $times
     * @return DeviceProperty
     */
    public function createDeviceProperty(array $attributes = [], int $times = null)
    {
        return factory(DeviceProperty::class, $times)->create($attributes);
    }

    /**
     * Create a new device log record
     *
     * @param array $attributes
     * @param int $times
     * @return DeviceLog
     */
    public function createDeviceLog(array $attributes = [], int $times = null)
    {
        return factory(DeviceLog::class, $times)->create($attributes);
    }

    public function registerTestDeviceConfig()
    {
        $this->app['config']->set('devices', array_merge($this->app['config']->get('devices', []), [
            'test_device' => [
                'name' => 'Test device',
                'class' => TestDevice::class,
            ]
        ]));
    }
}


class TestDevice extends \SmartHome\App\Devices\Device
{
    protected $properties = [
        'test' => TestProperty::class,
        'loggable' => TestLoggableProperty::class,
    ];

    /**
     * @param string $key
     * @param string $class
     */
    public function registerProperty(string $key, string $class)
    {
        $this->properties[$key] = $class;
    }
}

class TestProperty extends \SmartHome\App\Devices\Property
{
    public function transform($value)
    {
        return $value;
    }
}

class TestLoggableProperty extends \SmartHome\App\Devices\Property implements DevicePropertyLoggable
{
    public function transform($value)
    {
        return $value;
    }
}