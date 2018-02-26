<?php

namespace SmartHome\App\Devices;

use SmartHome\App\Contracts\Device as DeviceContract;
use SmartHome\App\Contracts\DeviceProperty as DevicePropertyContract;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException;
use Illuminate\Contracts\Foundation\Application;

abstract class Device implements DeviceContract
{
    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var Application
     */
    protected $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @return array|string[]
     */
    public function properties(): array
    {
        return $this->properties;
    }

    /**
     * Получение списка команд для свойства устроства
     *
     * @param string $property
     * @return array|string[]
     * @throws DevicePropertyNotFoundException
     */
    public function commands(string $property): array
    {
        return $this->propertyDriver($property)->commands();
    }

    /**
     * @param DeviceProperty $property
     * @param string $method
     * @param array ...$parameters
     * @throws DevicePropertyNotFoundException
     */
    public function runCommand(DeviceProperty $property, string $method, ...$parameters): void
    {
        $propertyObject = $this->propertyDriver($property->key);
        $propertyObject->setDeviceProperty($property);

        $propertyObject->$method($property, ...$parameters);
    }

    /**
     * получение объекта свойства
     *
     * @param string $property
     * @return DevicePropertyContract
     * @throws DevicePropertyNotFoundException
     */
    public function propertyDriver(string $property): DevicePropertyContract
    {
        $propertyClass = $this->propertyClass($property);

        if (!$propertyClass) {
            throw new DevicePropertyNotFoundException(
                sprintf('Driver [%s]: property nof found %s.', get_class($this), $property)
            );
        }

        return $this->app->make($propertyClass);
    }

    /**
     * @param string $property
     * @return mixed|string
     */
    public function propertyClass(string $property): string
    {
        return array_get($this->properties(), $property);
    }
}