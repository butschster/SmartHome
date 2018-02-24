<?php

namespace SmartHome\Http\Rooms\Resources;

use Illuminate\Http\Resources\Json\Resource;
use SmartHome\Domain\Rooms\Entities\Room;
use SmartHome\Http\Devices\Resources\DevicePropertyCollection;

/**
 * @mixin Room
 */
class RoomResource extends Resource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'position' => $this->position,
            'properties' => new DevicePropertyCollection($this->whenLoaded('deviceProperties')),
            'links' => [
                'self' => route('room.show', $this->id),
                'list' => route('rooms')
            ],
        ];
    }
}
