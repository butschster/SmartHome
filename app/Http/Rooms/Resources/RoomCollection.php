<?php

namespace SmartHome\Http\Rooms\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use SmartHome\Domain\Rooms\Entities\Room;

/**
 * @mixin Room
 */
class RoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Room $room) {
            return new RoomResource($room);
        });
    }
}
