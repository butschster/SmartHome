<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;

class BasicController
{
    /**
     * @param Response $response
     * @param string $type
     * @param string $device
     * @throws \App\Exceptions\UnknownDeviceException
     */
    public function log(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);
        event(new \App\Events\Device\Ping($device));
    }
}