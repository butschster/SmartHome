<?php

namespace SmartHome\App\Devices\Properties;

use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;
use SmartHome\App\Devices\Property;

class Temperature extends Property implements DevicePropertyLoggable
{
    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        return (float) round($value, 1);
    }

    /**
     * @return array
     */
    public function meta(): array
    {
        return [
            'units' => '℃'
        ];
    }
}