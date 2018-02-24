<?php

namespace SmartHome\Mqtt\Controllers\Xiaomi;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Mqtt\Contracts\Response;

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
        $device = Device::register($device, 'xiaomi_' . $type);
        $device->setProperties($response->toArray());
        
        event(new \SmartHome\Domain\Devices\Events\Device\Ping($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}