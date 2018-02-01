<?php

$router->namespace('App\\Mqtt\\Controllers\\');

// Sonoff
$router->listen('tele/{device}/LWT', 'Sonoff\BasicController@lwt');

$router->listen('tele/{device}/INFO1', 'Sonoff\BasicTelemetryController@info');
$router->listen('tele/{device}/STATE', 'Sonoff\BasicTelemetryController@state');
$router->listen('tele/{device}/UPTIME', 'Sonoff\BasicTelemetryController@uptime');

$router->listen('stat/{device}/POWER', 'Sonoff\BasicStatusController@power');
$router->listen('stat/{device}/RESULT', 'Sonoff\BasicStatusController@result');
$router->listen('cmnd/{device}/POWER', 'Sonoff\BasicCommandController@power');
