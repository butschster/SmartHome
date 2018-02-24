<?php

namespace SmartHome\Http\Devices\Resources;

use Illuminate\Http\Resources\Json\Resource;
use SmartHome\Domain\Devices\Entities\Device;

/**
 * @mixin Device
 */
class DeviceResource extends Resource
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
            'type' => $this->type,
            'name' => $this->name ?: sprintf('%s [%s]', $this->type, $this->key),
            'description' => $this->description,
            'properties' => new DevicePropertyCollection($this->whenLoaded('properties')),
            'last_activity' => $this->formatted_last_activity,
            'links' => [
                'self' => route('device.show', $this->id),
                'list' => route('devices')
            ],
        ];
    }
}
