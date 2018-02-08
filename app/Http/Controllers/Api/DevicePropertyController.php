<?php

namespace App\Http\Controllers\Api;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use App\Http\Resources\DevicePropertyCollection;
use App\Http\Resources\DevicePropertyResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DevicePropertyController extends Controller
{
    /**
     * Получение списка всех свойств всех девайсов
     *
     * @return DevicePropertyCollection
     */
    public function all(): DevicePropertyCollection
    {
        return new DevicePropertyCollection(
            DeviceProperty::get()
        );
    }

    /**
     * Получение списка всех свойств для девайса
     *
     * @param Device $device
     * @return DevicePropertyCollection
     */
    public function index(Device $device): DevicePropertyCollection
    {
        return new DevicePropertyCollection(
            $device->properties()->get()
        );
    }

    /**
     * @param DeviceProperty $property
     * @return DevicePropertyResource
     */
    public function show(DeviceProperty $property): DevicePropertyResource
    {
        return new DevicePropertyResource($property);
    }

    /**
     * @param Request $request
     * @param DeviceProperty $property
     * @return DevicePropertyResource
     */
    public function update(Request $request, DeviceProperty $property): DevicePropertyResource
    {
        //$this->authorize('update', $property);

        $validatedData = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $property->update($validatedData);

        return $this->show($property);
    }
}
