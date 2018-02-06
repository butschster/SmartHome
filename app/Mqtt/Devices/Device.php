<?php

namespace App\Mqtt\Devices;

use App\Contracts\Mqtt\Device as DeviceContract;
use App\Contracts\Mqtt\DeviceProperty as DevicePropertyContract;
use App\Entities\DeviceProperty;
use App\Exceptions\DevicePropertyNotFoundException;
use Illuminate\Contracts\Foundation\Application;

abstract class Device implements DeviceContract
{
    /**
     * @var array
     */
    protected $allowedProperties = [];

    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var string
     */
    protected $id;
    /**
     * @var Application
     */
    private $app;

    /**
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }

    /**
     * Получение идентификатора устройства
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param array $properties
     * @return void
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param string $property
     * @return mixed
     */
    public function property(string $property)
    {
        return array_get($this->properties, $property);
    }

    /**
     * @return array
     */
    public function allowedProperties(): array
    {
        return $this->allowedProperties;
    }

    /**
     * Получение списка команд для свойства устроства
     *
     * @param string $property
     * @return array
     * @throws DevicePropertyNotFoundException
     */
    public function allowedCommands(string $property): array
    {
        return $this->propertyDriver($property)->getCommands();
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
        return array_get($this->allowedProperties(), $property);
    }
}