<?php

namespace SmartHome\Http\Devices\Resources;

use Illuminate\Http\Resources\Json\Resource;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Exceptions\DevicePropertyNotFoundException;
use SmartHome\Http\Rooms\Resources\RoomCollection;

/**
 * @mixin DeviceProperty
 */
class DevicePropertyResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     * @throws DevicePropertyNotFoundException
     * @throws \ReflectionException
     */
    public function toArray($request)
    {
        $driver = $this->driver();

        return [
            'id' => $this->id,
            'device_id' => $this->device_id,
            'type' => (new \ReflectionClass($driver))->getShortName(),
            'key' => $this->key,
            'value' => $this->value,
            'formatted_value' => $driver->format($this->value),
            'name' => $this->name ?: $this->key,
            'description' => $this->description,
            'meta' => $driver->meta(),
            'commands' => array_values($this->commands()),
            'rooms' => new RoomCollection($this->whenLoaded('rooms')),
            'links' => [
                'device' => route('device.show', $this->device_id),
                'self' => route('device.property.show', $this->id),
                'list' => route('device.properties', $this->device_id)
            ],
        ];
    }
}
