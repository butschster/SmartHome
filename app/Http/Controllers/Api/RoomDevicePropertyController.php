<?php

namespace App\Http\Controllers\Api;

use App\Entities\DeviceProperty;
use App\Entities\Room;
use App\Http\Resources\DevicePropertyCollection;
use App\Http\Resources\RoomCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class RoomDevicePropertyController extends Controller
{
    /**
     * @param Room $room
     * @return DevicePropertyCollection
     */
    public function properties(Room $room): DevicePropertyCollection
    {
        return new DevicePropertyCollection(
            $room->deviceProperties
        );
    }

    /**
     * @param DeviceProperty $property
     * @return RoomCollection
     */
    public function rooms(DeviceProperty $property): RoomCollection
    {
        return new RoomCollection(
            $property->rooms
        );
    }

    /**
     * Привязка устройства к помещению
     *
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request, Room $room)
    {
        $this->authorize('update', new Room);

        $request->validate([
            'id' => ['required', Rule::exists((new DeviceProperty)->getTable(), 'id')]
        ]);

        $room->deviceProperties()->attach($request->input('id'));

        return response_ok();
    }

    /**
     * Отвязка устройства от помещения
     *
     * @param Request $request
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, Room $room)
    {
        $this->authorize('update', new Room);

        $request->validate([
            'id' => 'required'
        ]);

        $room->deviceProperties()->detach($request->input('id'));

        return response_ok();
    }
}
