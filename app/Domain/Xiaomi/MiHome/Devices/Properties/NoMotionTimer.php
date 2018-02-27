<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices\Properties;

use SmartHome\App\Devices\Property;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Events\NoMotions;

class NoMotionTimer extends Property
{
    /**
     * Преобразование значения к нужному виду
     *
     * @param mixed $seconds
     * @return mixed
     */
    public function transform($seconds)
    {
        return (int) $seconds;
    }

    /**
     * @param mixed $seconds
     * @return array|mixed
     */
    public function format($seconds)
    {
        $date = now()->subSeconds($seconds);

        return [
            'from' => $date->timestamp,
            'humanize' => $seconds > 0 ? $date->diffForHumans() : null
        ];
    }

    public function event()
    {
        return NoMotions::class;
    }
}