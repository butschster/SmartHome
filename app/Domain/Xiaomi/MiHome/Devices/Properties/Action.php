<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\Domain\Devices\Contracts\DevicePropertyLoggable;
use SmartHome\App\Devices\Property;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Events\ButtonPressed;

class Action extends Property implements DevicePropertyLoggable
{
    const ACTION_CLICK = 'click';
    const ACTION_DOUBLE_CLICK = 'double_click';
    const ACTION_LONG_CLICK_PRESS = 'long_click_press';
    const ACTION_LONG_CLICK_RELEASE = 'long_click_release';

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

    public function event()
    {
        return ButtonPressed::class;
    }
}