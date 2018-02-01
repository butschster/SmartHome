<?php

return [
    'host' => env('MQTT_HOST', 'localhost'),
    'port' => env('MQTT_PORT', 1883),
    'client_id' => env('APP_NAME', 'SmartHome'),
    'username' => env('MQTT_USERNAME'),
    'password' => env('MQTT_PASSWORD'),
];