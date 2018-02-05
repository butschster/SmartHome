<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;
use App\Events\DevicePing;

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

        $device->setProperties($response->toArray());

        event(new DevicePing($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}