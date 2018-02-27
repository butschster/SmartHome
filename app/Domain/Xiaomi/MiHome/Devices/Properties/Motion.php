<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\App\Devices\Property;
use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;

class Motion extends Property implements DevicePropertyLoggable
{
    const STATUS_MOTION = 'motion';
    const STATUS_NO_MOTION = 'no_motion';

    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $value
     * @return mixed
     */
    public function transform($value)
    {
        if (in_array(strtolower($value), ['motion', 1])) {
            return static::STATUS_MOTION;
        }

        return static::STATUS_NO_MOTION;
    }

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        return trans('device.motion.'.$value);
    }
}