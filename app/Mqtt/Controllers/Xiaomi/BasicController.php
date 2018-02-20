<?php

namespace App\Mqtt\Controllers\Xiaomi;

use App\Entities\Device;
use App\Mqtt\Response;

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
        $device = Device::register($device, 'xiaomi_' . $type);
        $device->setProperties($response->toArray());
        
        event(new \App\Events\Device\Ping($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}