<?php

use SmartHome\Domain\Xiaomi\Devices as XiaomiDevices;
use SmartHome\Domain\Sonoff\Devices as SonoffDevices;
use SmartHome\Domain\Xiaomi\MiHome\Devices\{
    Button, Gateway, Magnet, Motion, Thermometer
};
use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Action, Battery, Door, Humidity, Motion as MotionProperty, Pressure, Temperature
};

use SmartHome\Domain\Sonoff\Devices\Properties\Power;

return [
    'action' => [
        Action::ACTION_CLICK => 'Нажатие',
        Action::ACTION_LONG_CLICK_PRESS => 'Долгое нажатие',
        Action::ACTION_LONG_CLICK_RELEASE => 'Кнопка отпущена',
        Action::ACTION_DOUBLE_CLICK => 'Двойное нажатие'
    ],
    'door' => [
        Door::STATUS_OPEN => 'Открыто',
        Door::STATUS_CLOSED => 'Закрыто'
    ],
    'motion' => [
        MotionProperty::STATUS_MOTION => 'Движение',
        MotionProperty::STATUS_NO_MOTION => 'Нет движения'
    ],
    'power' => [
        Power::STATUS_ON => 'Включен',
        Power::STATUS_OFF => 'Выключен'
    ],
    'devices' => [
        // Xiaomi
        Gateway::class => [
            'name' => 'Xiaomi Mi Smart Home Gateway'
        ],
        Motion::class => [
            'name' => 'Xiaomi Mi Smart Home Motion Sensor',
        ],
        Button::class => [
            'name' => 'Xiaomi Mi Smart Home Button',
        ],
        Magnet::class => [
            'name' => 'Xiaomi Mi Smart Home Door Sensor',
        ],
        Thermometer::class => [
            'name' => 'Xiaomi Mi Smart Home Temperature / Humidity Sensor',
        ],

        // Sonoff
        SonoffDevices\BasicRelay::class => [
            'name' => 'Sonoff Basic',
        ],
        SonoffDevices\DualRelay::class => [
            'name' => 'Sonoff Basic',
        ],
    ],
    'properties' => [
        Action::class => [
            'name' => 'Нопка'
        ],
        Battery::class => [
            'name' => 'Заряд',
        ],
        Door::class => [
            'name' => 'Состояние'
        ],
        Humidity::class => [
            'name' => 'Влажность'
        ],
        MotionProperty::class => [
            'name' => 'Движение'
        ],
        Pressure::class => [
            'name' => 'Давление'
        ],
        Temperature::class => [
            'name' => 'Температура'
        ],
        Power::class => [
            'name' => 'Реле'
        ]
    ]
];