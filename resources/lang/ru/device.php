<?php

use App\Mqtt\Devices\Properties\Door;

return [
    'action' => [
        'click' => 'Нажатие',
        'long_press' => 'Долгое нажатие',
        'double_click' => 'Двойное нажатие'
    ],
    'door' => [
        Door::STATUS_OPEN => 'Открыто',
        Door::STATUS_CLOSED => 'Закрыто'
    ]
];