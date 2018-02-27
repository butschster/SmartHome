<?php

Artisan::command('test:command', function () {

    dispatch(new \SmartHome\Domain\Xiaomi\MiHome\Jobs\SendCommand(
        new \SmartHome\Domain\Xiaomi\MiHome\Gateway\Commands\GatewayLight('e61919', 1000),
        '192.168.2.52', '7811dcb2640b', 'gateway'
    ));

});