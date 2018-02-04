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
     */
    public function log(Response $response, string $type, string $device)
    {
        Device::register($device, $type);
    }
}