<?php

namespace App\Mqtt\Devices\Xiaomi;

use App\Mqtt\Devices\Device;
use App\Mqtt\Devices\Properties\Action;

class Button extends Device
{
    /**
     * @var array
     */
    protected $allowedProperties = [
        'action' => Action::class
    ];
}