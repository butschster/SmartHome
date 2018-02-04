<?php

namespace App\Http\Controllers\Api;

use App\Entities\Device;
use App\Http\Resources\DeviceCollection;
use App\Http\Resources\DeviceResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    /**
     * @return DeviceCollection
     */
    public function index()
    {
        return new DeviceCollection(
            Device::with('properties')->get()
        );
    }

    /**
     * @param Device $device
     * @return DeviceResource
     */
    public function show(Device $device)
    {
        return new DeviceResource($device->load('properties', 'properties.rooms'));
    }

    /**
     * @param Request $request
     * @param Device $device
     * @return DeviceResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Device $device)
    {
        //$this->authorize('update', $device);

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $device->update($validatedData);

        return new DeviceResource($device);
    }
}
