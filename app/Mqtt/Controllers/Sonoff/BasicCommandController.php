<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;
use App\Contracts\Device as DeviceContract;

class BasicCommandController
{
    /**
     * @param Response $response
     * @param string $device
     */
    public function power(Response $response, string $device)
    {
    }
}