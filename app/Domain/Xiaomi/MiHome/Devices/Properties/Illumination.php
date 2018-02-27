<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\App\Devices\Property;
use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;

class Illumination extends Property implements DevicePropertyLoggable
{
    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        return $value;
    }
}