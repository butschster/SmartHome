<?php

namespace App\Http\Resources;

use App\Entities\DeviceProperty;
use Illuminate\Http\Resources\Json\Resource;

/**
 * @mixin DeviceProperty
 */
class DevicePropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'key' => $this->key,
            'value' => $this->value,
            'name' => $this->name ?: $this->key,
            'description' => $this->description,
            'commands' => array_values($this->getCommands()),
            'rooms' => new RoomCollection($this->whenLoaded('rooms')),
            'links' => [
                'device' => route('device.show', $this->device_id),
                'self' => route('device.property.show', $this->id),
                'list' => route('device.properties', $this->device_id)
            ],
        ];
    }
}
