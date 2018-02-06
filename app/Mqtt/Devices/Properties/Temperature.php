<?php

namespace App\Mqtt\Devices\Properties;

use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Mqtt\Devices\Property;

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
        return (float) $value;
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