<?php

$router->namespace('App\\Mqtt\\Controllers\\');

// Sonoff
$router->listen('tele/{type}/{device}/LWT', 'Sonoff\BasicController@log');

$router->listen('tele/{type}/{device}/INFO1', 'Sonoff\BasicController@log');
$router->listen('tele/{type}/{device}/UPTIME', 'Sonoff\BasicController@log');
$router->listen('tele/{type}/{device}/STATE', 'Sonoff\BasicTelemetryController@state');

$router->listen('stat/{type}/{device}/POWER', 'Sonoff\BasicController@log');
$router->listen('stat/{type}/{device}/RESULT', 'Sonoff\BasicStatusController@result');

//$router->listen('cmnd/{type}/{device}/POWER', 'Sonoff\BasicController@log');

// Xiaomi


$router->listen('xiaomi/{type}/{device}/status', 'Xiaomi\BasicController@log');