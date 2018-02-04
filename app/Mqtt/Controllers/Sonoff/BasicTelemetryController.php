<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;

class BasicTelemetryController
{
    /**
     * Получение периодически отправляемых данных состояния устройства
     *
     * @param Response $response
     * @param string $type
     * @param string $device
     */
    public function state(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);

        $payload = $response->toArray();
        $device->setProperties(array_only($payload, ['POWER', 'POWER1', 'POWER2', 'POWER3', 'POWER4']));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}