<?php

namespace SmartHome\App\Devices;

use SmartHome\App\Contracts\Device;
use SmartHome\App\Contracts\DeviceManager as DeviceManagerContract;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Manager;
use SmartHome\App\Exceptions\DeviceDriverNotFoundException;

class DeviceManager extends Manager implements DeviceManagerContract
{
    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        throw new \BadMethodCallException('Default driver not exists');
    }

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers()
    {
        return $this->app['config']->get('devices') ?: [];
    }

    /**
     * Create a new driver instance.
     *
     * @param  string $driver
     * @return mixed
     *
     * @throws DeviceDriverNotFoundException
     */
    protected function createDriver($driver): Device
    {
        if (isset($this->customCreators[$driver])) {
            return $this->callCustomCreator($driver);
        }

        $deviceDrivers = $this->getDrivers();

        if (isset($deviceDrivers[$driver])) {
            return $this->makeClass($deviceDrivers[$driver]);
        }

        throw new DeviceDriverNotFoundException("Driver [$driver] not supported.");
    }

    /**
     * @param string $driver
     * @return Device
     */
    protected function callCustomCreator($driver): Device
    {
        if (is_array($this->customCreators[$driver])) {
            return $this->makeClass($this->customCreators[$driver]);
        }

        return parent::callCustomCreator($driver);
    }

    /**
     * @param string $driver
     * @param array|string $data
     * @return $this
     */
    public function register($driver, $data)
    {
        if (is_string($data)) {
            $data = ['class' => $data];
        }

        $this->customCreators[$driver] = $data;

        return $this;
    }

    /**
     * @param array $data
     * @return Device
     */
    protected function makeClass(array $data): Device
    {
        return $this->app->make($data['class']);
    }

    public function extend($driver, Closure $callback)
    {
        throw new \BadMethodCallException('Method not allowed');
    }
}