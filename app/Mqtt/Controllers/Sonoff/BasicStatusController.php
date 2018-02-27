<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Mqtt\Router\Request;

class BasicStatusController
{
    /**
     * Получение результата выполнения команды.
     *
     * @param Request $request
     * @param string $type
     * @param string $device
     * @param Device $registeredDevice
     */
    public function result(Request $request, string $type, string $device, Device $registeredDevice = null)
    {
        if ($registeredDevice) {
            $registeredDevice->setProperties($request->toArray());
        }
    }
}