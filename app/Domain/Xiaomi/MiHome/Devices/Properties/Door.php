<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;
use SmartHome\App\Devices\Property;

class Door extends Property implements DevicePropertyLoggable
{
    const STATUS_OPEN = 1;
    const STATUS_CLOSED = 0;

    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        if (in_array(strtolower($value), ['open', 1])) {
            return static::STATUS_OPEN;
        }

        return static::STATUS_CLOSED;
    }

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        return trans('device.door.'.$value);
    }
}