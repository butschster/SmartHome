<?php

namespace App\Http\Resources;

use App\Entities\DeviceProperty;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin DeviceProperty
 */
class DevicePropertyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (DeviceProperty $property) {
            return new DevicePropertyResource($property);
        });
    }
}
