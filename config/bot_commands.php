<?php

return [
    \SmartHome\Domain\Rooms\Commands\SwitchOnCommand::class => [
        'command' => 'room:switch_on',
        'voice' => [
            'triggers' => [
                'включи свет в *',
                'включи свет на *'
            ],
            'smart' => true
        ]
    ],
    \SmartHome\Domain\Rooms\Commands\SwitchOffCommand::class => [
        'command' => 'room:switch_off',
        'voice' => [
            'triggers' => [
                'выключи свет в *',
                'выключи свет на *'
            ],
            'smart' => true
        ]
    ],
    \SmartHome\Domain\Weather\Commands\SayCurrentWeather::class => [
        'command' => 'weather',
        'voice' => [
            'triggers' => [
                'какая сегодня погода'
            ]
        ]
    ]
];