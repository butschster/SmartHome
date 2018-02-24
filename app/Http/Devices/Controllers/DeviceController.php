<?php

namespace SmartHome\Http\Devices\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Http\Devices\Resources\DeviceCollection;
use SmartHome\Http\Devices\Resources\DeviceLogsCollection;
use SmartHome\Http\Devices\Resources\DeviceResource;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * @return DeviceCollection
     */
    public function index(): DeviceCollection
    {
        return new DeviceCollection(
            Device::with('properties')->get()
        );
    }

    /**
     * @param Device $device
     * @return DeviceLogsCollection
     */
    public function logs(Device $device): DeviceLogsCollection
    {
        return new DeviceLogsCollection(
            $device->logs()->latest()->paginate()
        );
    }

    /**
     * @param Device $device
     * @return DeviceResource
     */
    public function show(Device $device): DeviceResource
    {
        return new DeviceResource(
            $device->load('properties', 'properties.rooms')
        );
    }

    /**
     * @param Request $request
     * @param Device $device
     * @return DeviceResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Device $device): DeviceResource
    {
        $this->authorize('update', $device);

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $device->update($validatedData);

        return $this->show($device);
    }

    /**
     * @param Device $device
     * @return array
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Device $device)
    {
        $this->authorize('destroy', $device);

        $device->delete();

        return response_ok();
    }
}
