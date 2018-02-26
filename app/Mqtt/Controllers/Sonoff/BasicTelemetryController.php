<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Mqtt\Contracts\Response;
use SmartHome\Domain\Devices\Entities\Device;

class BasicTelemetryController
{
    /**
     * Получение периодически отправляемых данных состояния устройства
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