<?php

namespace SmartHome\App\Contracts;

use SmartHome\Domain\Devices\Entities\DeviceProperty;

interface Switchable
{
    /**
     * Включение
     *
     * @param DeviceProperty $property
     * @return void
     */
    public function switchOn(DeviceProperty $property): void;

    /**
     * @param DeviceProperty $property
     * @return void
     */
    public function switchOff(DeviceProperty $property): void;
}