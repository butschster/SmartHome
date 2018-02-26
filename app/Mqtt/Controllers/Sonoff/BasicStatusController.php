<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Mqtt\Router\Response;

class BasicStatusController
{
    /**
     * Получение результата выполнения команды.
     *
     * @param Response $response
     * @param string $type
     * @param string $device
     * @param Device $registeredDevice
     */
    public function result(Response $response, string $type, string $device, Device $registeredDevice = null)
    {
        if ($registeredDevice) {
            $registeredDevice->setProperties($response->toArray());
        }
    }
}