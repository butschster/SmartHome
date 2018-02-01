<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Device as DeviceContract;
use App\Contracts\Mqtt\Response;
use App\Entities\Device;

class BasicController
{
    /**
     * @param Response $response
     * @param string $device
     */
    public function lwt(Response $response, string $device)
    {
        Device::getByKey($device, DeviceContract::SOURCE_MQTT, DeviceContract::TYPE_SONOFF_BASIC);
    }
}