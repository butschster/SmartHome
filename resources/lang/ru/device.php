<?php

use SmartHome\App\Devices\Properties\Door;
use SmartHome\Domain\Sonoff\Devices\Properties\Power;

return [
    'action' => [
        'click' => 'Нажатие',
        'long_press' => 'Долгое нажатие',
        'double_click' => 'Двойное нажатие'
    ],
    'door' => [
        Door::STATUS_OPEN => 'Открыто',
        Door::STATUS_CLOSED => 'Закрыто'
    ],
    'power' => [
        Power::STATUS_ON => 'Включен',
        Power::STATUS_OFF => 'Выключен'
    ]
];