<?php

namespace SmartHome\Http\Xiaomi\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Xiaomi\Entities\Gateway;
use SmartHome\Http\Devices\Resources\DeviceCollection;

class GatewayDevicesController extends Controller
{
    /**
     * @param Gateway $gateway
     * @return DeviceCollection
     */
    public function index(Gateway $gateway): DeviceCollection
    {
        return new DeviceCollection(
            $gateway->devices
        );
    }
}