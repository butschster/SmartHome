<?php

namespace App\Contracts\Mqtt;

interface DeviceProperty
{
    /**
     * @param \App\Entities\DeviceProperty $deviceProperty
     */
    public function setDeviceProperty(\App\Entities\DeviceProperty $deviceProperty): void;

    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value);

    /**
     * @return array
     */
    public function meta(): array;

    /**
     * @return array
     */
    public function getCommands(): array;

    /**
     * @param string $message
     */
    public function runCommand(string $message): void;
}