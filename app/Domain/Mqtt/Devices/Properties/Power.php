<?php

namespace SmartHome\Domain\Mqtt\Devices\Properties;

use SmartHome\Domain\Mqtt\Contracts\Switchable;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Mqtt\Devices\Property;

class Power extends Property implements Switchable
{
    const STATUS_ON = 1;
    const STATUS_OFF = 0;

    /**
     * @var array
     */
    protected $commands = [
        'switchOn',
        'switchOff',
        'toggle'
    ];

    /**
     * Преобразование значения к нужному виду
     *
     * @param string $value
     * @return int
     */
    public function transform($value): int
    {
        return $this->validateAccepted(null, strtolower($value))
            ? static::STATUS_ON
            : static::STATUS_OFF;
    }

    /**
     * @param DeviceProperty $property
     */
    public function switchOn(DeviceProperty $property): void
    {
        $this->runCommand(1);
        $this->log(__METHOD__);
    }

    public function switchOff(DeviceProperty $property): void
    {
        $this->runCommand(0);
        $this->log(__METHOD__);
    }

    /**
     * @param DeviceProperty $property
     */
    public function toggle(DeviceProperty $property): void
    {
        if ($property->value == 1) {
            $this->switchOff($property);
        } else {
            $this->switchOn($property);
        }
    }

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        return trans('device.power.'.$value);
    }
}