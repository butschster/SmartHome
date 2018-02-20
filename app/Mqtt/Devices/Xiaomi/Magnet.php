<?php

namespace App\Mqtt\Devices\Xiaomi;

use App\Mqtt\Devices\Device;
use App\Mqtt\Devices\Properties\Door;

class Magnet extends Device
{
    /**
     * @var array
     */
    protected $properties = [
        'state' => Door::class
    ];
}