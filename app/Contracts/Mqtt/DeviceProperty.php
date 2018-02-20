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
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function format($value);

    /**
     * @return array
     */
    public function meta(): array;

    /**
     * @return array
     */
    public function commands(): array;

    /**
     * @param string $message
     */
    public function runCommand(string $message): void;
}