<?php

namespace App\Mqtt\Devices\Sonoff;

use App\Contracts\Device;
use App\Mqtt\Commands\Sonoff\Power;

class BasicRelay implements Device
{
    /**
     * @var array
     */
    protected $properties = [];

    /**
     * @var Power
     */
    protected $power;

    /**
     * @var string
     */
    protected $id;

    /**
     * @param Power $power
     */
    public function __construct(Power $power)
    {
        $this->power = $power;
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
     * @param string $key
     * @return mixed
     */
    public function property(string $key)
    {
        return array_get($this->properties, $key);
    }

    /**
     * @return \React\Promise\ExtendedPromiseInterface
     */
    public function toggle()
    {
        if ($this->property('status') == 'OFF') {
            return $this->power->switchOn($this->id);
        }

        return $this->power->switchOff($this->id);
    }
}