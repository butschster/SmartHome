<?php

return [
    \App\Voice\Commands\Room\SwitchOnCommand::class => [
        'command' => 'room:switch_on',
        'voice' => [
            'triggers' => [
                'включи свет в *',
                'включи свет на *'
            ],
            'smart' => true
        ]
    ],
    \App\Voice\Commands\Room\SwitchOffCommand::class => [
        'command' => 'room:switch_off',
        'voice' => [
            'triggers' => [
                'выключи свет в *',
                'выключи свет на *'
            ],
            'smart' => true
        ]
    ],
    \App\Voice\Commands\Weather::class => [
        'command' => 'weather',
        'voice' => [
            'triggers' => [
                'какая сегодня погода'
            ]
        ]
    ]
];