<?php

use App\Contracts\Device;

return [

    Device::TYPE_SONOFF_BASIC => [
        'title' => 'Sonoff Basic',
        'class' => App\Mqtt\Devices\Sonoff\BasicRelay::class,
    ]

];