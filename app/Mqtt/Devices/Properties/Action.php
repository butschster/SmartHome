<?php

namespace App\Mqtt\Devices\Properties;

use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Mqtt\Devices\Property;

class Action extends Property implements DevicePropertyLoggable
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

    /**
     * @param mixed $value
     * @return array|\Illuminate\Contracts\Translation\Translator|mixed|null|string
     */
    public function format($value)
    {
        return trans('device.action.'.$value);
    }
}