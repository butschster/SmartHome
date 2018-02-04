<?php

use App\Contracts\Mqtt\Device;

return [

    Device::TYPE_SONOFF_BASIC => [
        'title' => 'Sonoff Basic',
        'class' => App\Mqtt\Devices\Sonoff\BasicRelay::class,
    ],

    Device::TYPE_SONOFF_DUAL => [
        'title' => 'Sonoff Dual',
        'class' => App\Mqtt\Devices\Sonoff\DualRelay::class,
    ]

];