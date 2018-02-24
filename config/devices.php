<?php

use SmartHome\Domain\Mqtt\Contracts\Device;

return [

    Device::TYPE_SONOFF_BASIC => [
        'name' => 'Sonoff Basic',
        'class' => SmartHome\Domain\Mqtt\Devices\Sonoff\BasicRelay::class,
    ],

    Device::TYPE_SONOFF_DUAL => [
        'name' => 'Sonoff Dual',
        'class' => SmartHome\Domain\Mqtt\Devices\Sonoff\DualRelay::class,
    ],

    Device::TYPE_XIAOMI_TH => [
        'name' => 'Xiaomi Mi Smart Home Temperature / Humidity Sensor',
        'class' => SmartHome\Domain\Mqtt\Devices\Xiaomi\Thermometer::class,
    ],

    Device::TYPE_XIAOMI_MAGNET => [
        'name' => 'Xiaomi Mi Smart Home Door Sensor',
        'class' => SmartHome\Domain\Mqtt\Devices\Xiaomi\Magnet::class,
    ],

    Device::TYPE_XIAOMI_BUTTON => [
        'name' => 'Xiaomi Mi Smart Home Button',
        'class' => SmartHome\Domain\Mqtt\Devices\Xiaomi\Button::class,
    ]

];