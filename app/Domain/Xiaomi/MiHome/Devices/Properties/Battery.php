<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\App\Devices\Property;
use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;

class Battery extends Property implements DevicePropertyLoggable
{
    const MIN_VOLT = 2800;
    const MAX_VOLT = 3300;

    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        return (int) $value;
    }

    /**
     * @return array
     */
    public function meta(): array
    {
        return [
            'units' => '%'
        ];
    }

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        return round(
            (static::MAX_VOLT - $value) / (static::MAX_VOLT - static::MIN_VOLT) * 100
        );
    }
}