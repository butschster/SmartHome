<?php

use SmartHome\Domain\Mqtt\Devices\Properties\{
    Door, Power
};

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