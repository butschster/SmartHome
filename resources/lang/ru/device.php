<?php

use SmartHome\Domain\Xiaomi\MiHome\Devices\Properties\{
    Action, Door, Motion
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
        Motion::STATUS_MOTION => 'Движение',
        Motion::STATUS_NO_MOTION => 'Нет движения'
    ],
    'power' => [
        Power::STATUS_ON => 'Включен',
        Power::STATUS_OFF => 'Выключен'
    ]
];