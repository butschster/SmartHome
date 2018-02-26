<?php

/** @var \SmartHome\Domain\Mqtt\Contracts\Router $router */

$router->namespace('SmartHome\\Mqtt\\Controllers\\');

// Sonoff
$router->listen('tele/{type}/{device}/LWT', 'Sonoff\BasicController@log');

$router->listen('tele/{type}/{device}/INFO1', 'Sonoff\BasicController@log');
$router->listen('tele/{type}/{device}/UPTIME', 'Sonoff\BasicController@log');
$router->listen('tele/{type}/{device}/STATE', 'Sonoff\BasicTelemetryController@state');

$router->listen('stat/{type}/{device}/POWER', 'Sonoff\BasicController@log');
$router->listen('stat/{type}/{device}/RESULT', 'Sonoff\BasicStatusController@result');

//$router->listen('cmnd/{type}/{device}/POWER', 'Sonoff\BasicController@log');