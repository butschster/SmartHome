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
     * @throws \SmartHome\Domain\Mqtt\Exceptions\UnknownDeviceException
     */
    public function state(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);

        $device->setProperties($response->toArray());

        event(new \SmartHome\Domain\Devices\Events\Device\Ping($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}