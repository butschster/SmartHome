<?php

namespace App\Http\Controllers\Api;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use App\Http\Resources\DevicePropertyCollection;
use App\Http\Resources\DevicePropertyResource;
use App\Http\Controllers\Controller;

class DevicePropertyController extends Controller
{
    /**
     * @param Device $device
     * @return DevicePropertyCollection
     */
    public function index(Device $device): DevicePropertyCollection
    {
        return new DevicePropertyCollection(
            $device->properties()->with('rooms')->get()
        );
    }

    /**
     * @param DeviceProperty $property
     * @return DevicePropertyResource
     */
    public function show(DeviceProperty $property): DevicePropertyResource
    {
        return new DevicePropertyResource($property->load('rooms'));
    }
}
