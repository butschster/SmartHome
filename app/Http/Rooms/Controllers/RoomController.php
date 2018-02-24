<?php

namespace SmartHome\Http\Rooms\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Rooms\Entities\Room;
use SmartHome\Http\Rooms\Resources\RoomCollection;
use SmartHome\Http\Rooms\Resources\RoomResource;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * @return RoomCollection
     */
    public function index(): RoomCollection
    {
        return new RoomCollection(
            Room::get()
        );
    }

    /**
     * @param Room $room
     * @return RoomResource
     */
    public function show(Room $room): RoomResource
    {
        return new RoomResource($room->load('deviceProperties'));
    }

    /**
     * @param Request $request
     * @return RoomResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request): RoomResource
    {
        $this->authorize('store', new Room);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'position' => 'nullable|numeric'
        ]);

        return $this->show(
            Room::create($validatedData)
        );
    }

    /**
     * @param Request $request
     * @param Room $room
     * @return RoomResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Room $room): RoomResource
    {
        $this->authorize('update', $room);

        $validatedData = $request->validate([
            'name' => 'string',
            'description' => 'nullable|string',
            'position' => 'nullable|numeric'
        ]);

        $room->update($validatedData);

        return $this->show($room);
    }

    /**
     * @param Room $room
     * @return array
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Room $room)
    {
        $this->authorize('destroy', $room);

        $room->delete();

        return response_ok();
    }
}
