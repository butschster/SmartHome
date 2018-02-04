<?php

namespace App\Http\Resources;

use App\Entities\Device;
use App\Entities\DeviceProperty;
use Illuminate\Http\Resources\Json\Resource;

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
            'links' => [
                'self' => route('device.show', $this->id),
                'list' => route('devices')
            ],
        ];
    }
}
