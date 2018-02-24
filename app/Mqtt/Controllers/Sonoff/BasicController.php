<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Mqtt\Contracts\Response;
use SmartHome\Domain\Devices\Entities\Device;

class BasicController
{
    /**
     * @param Response $response
     * @param string $type
     * @param string $device
     * @throws \SmartHome\Domain\Mqtt\Exceptions\UnknownDeviceException
     */
    public function log(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);
        event(new \SmartHome\Domain\Devices\Events\Device\Ping($device));
    }
}