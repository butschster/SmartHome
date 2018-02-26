<?php

namespace SmartHome\App\Contracts;

interface DeviceManager
{
    /**
     * @param string $driver
     * @param array|string $data
     * @return $this
     */
    public function register($driver, $data);

    /**
     * Get all of the created "drivers".
     *
     * @return array
     */
    public function getDrivers();
}