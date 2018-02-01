<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;
use BinSoul\Net\Mqtt\Message;
use App\Contracts\Device as DeviceContract;

class BasicTelemetryController
{
    /**
     * @param Response $response
     * @param string $device
     */
    public function state(Response $response, string $device)
    {
        $device = Device::getByKey($device, DeviceContract::SOURCE_MQTT, DeviceContract::TYPE_SONOFF_BASIC);

        $payload = $response->toArray();
        $device->setProperties(array_only($payload, ['POWER', 'POWER1', 'POWER2', 'POWER3', 'POWER4']));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }

    /**
     * @param Response $response
     * @param string $device
     */
    public function info(Response $response, string $device)
    {
        $device = Device::getByKey($device, DeviceContract::SOURCE_MQTT, DeviceContract::TYPE_SONOFF_BASIC);
    }

    public function uptime(Message $message, string $device)
    {

    }
}