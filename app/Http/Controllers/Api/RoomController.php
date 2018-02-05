<?php

namespace App\Http\Controllers\Api;

use App\Entities\Room;
use App\Http\Resources\RoomCollection;
use App\Http\Resources\RoomResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    /**
     * @return RoomCollection
     */
    public function index(): RoomCollection
    {
        return new RoomCollection(
            Room::with('deviceProperties')->get()
        );
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
            'position' => 'nullable|number'
        ]);

        $room = Room::create($validatedData);

        return new RoomResource($room);
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
     * @param Room $room
     * @return RoomResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Room $room): RoomResource
    {
        $this->authorize('update', $room);

        $validatedData = $request->validate([
            'name' => 'string',
            'description' => 'string',
            'position' => 'number'
        ]);

        $room->update($validatedData);

        return new RoomResource($room);
    }

    /**
     * @param Room $room
     * @return array
     * @throws \Exception
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Room $room): array
    {
        $this->authorize('destroy', $room);

        $room->delete();

        return response_ok();
    }
}
