<?php

namespace App\Http\Resources;

use App\Entities\Room;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
