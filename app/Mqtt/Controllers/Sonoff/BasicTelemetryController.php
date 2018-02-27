<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Mqtt\Contracts\Request;
use SmartHome\Domain\Devices\Entities\Device;

class BasicTelemetryController
{
    /**
     * Получение периодически отправляемых данных состояния устройства
     *
     * @param Request $request
     * @param string $type
     * @param string $device
     * @param Device $registeredDevice
     */
    public function state(Request $request, string $type, string $device, Device $registeredDevice = null)
    {
        if ($registeredDevice) {
            $registeredDevice->setProperties($request->toArray());
        }
    }
}