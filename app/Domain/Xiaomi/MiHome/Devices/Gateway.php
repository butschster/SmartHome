<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Devices;

use SmartHome\App\Devices\Device;
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Battery, Illumination, RGB
};

class Gateway extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'illumination' => Illumination::class,
        'rgb' => RGB::class,
    ];
}