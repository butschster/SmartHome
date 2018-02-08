<?php

use App\Contracts\Mqtt\Device;

return [

    Device::TYPE_SONOFF_BASIC => [
        'name' => 'Sonoff Basic',
        'class' => App\Mqtt\Devices\Sonoff\BasicRelay::class,
    ],

    Device::TYPE_SONOFF_DUAL => [
        'name' => 'Sonoff Dual',
        'class' => App\Mqtt\Devices\Sonoff\DualRelay::class,
    ],

    Device::TYPE_XIAOMI_TH => [
        'name' => 'Xiaomi Mi Smart Home Temperature / Humidity Sensor',
        'class' => App\Mqtt\Devices\Xiaomi\Thermometer::class,
    ],

    Device::TYPE_XIAOMI_MAGNET => [
        'name' => 'Xiaomi Mi Smart Home Door Sensor',
        'class' => App\Mqtt\Devices\Xiaomi\Magnet::class,
    ],

    Device::TYPE_XIAOMI_BUTTON => [
        'name' => 'Xiaomi Mi Smart Home Button',
        'class' => App\Mqtt\Devices\Xiaomi\Button::class,
    ]

];