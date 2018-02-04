<?php

namespace App\Mqtt\Devices;

use App\Contracts\Mqtt\Device as DeviceContract;
use App\Contracts\Mqtt\DeviceProperty as DevicePropertyContract;
use App\Entities\DeviceProperty;
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

    public function setUp()
    {

    }

    /**
     * Получение списка команд для свойства устроства
     *
     * @param string $property
     * @return array
     */
    public function allowedCommands(string $property): array
    {
        return $this->createPropertyObject($property)->getCommands();
    }

    /**
     * @param DeviceProperty $property
     * @param string $method
     * @param array ...$parameters
     */
    public function runCommand(DeviceProperty $property, string $method, ...$parameters): void
    {
        $propertyObject = $this->createPropertyObject($property->key);
        $propertyObject->setDeviceProperty($property);

        $propertyObject->$method($property, ...$parameters);
    }

    /**
     * @param string $property
     * @return DevicePropertyContract
     */
    protected function createPropertyObject(string $property): DevicePropertyContract
    {
        $propertyClass = array_get($this->allowedProperties(), $property);

        return $this->app->make($propertyClass);
    }
}