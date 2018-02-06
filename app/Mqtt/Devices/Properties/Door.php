<?php

namespace App\Mqtt\Devices\Properties;

use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Mqtt\Devices\Property;

class Door extends Property implements DevicePropertyLoggable
{
    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        if (strtolower($value) == 'open') {
            return 1;
        }

        return 0;
    }
}