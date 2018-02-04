<?php

namespace App\Http\Resources;

use App\Entities\Device;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @mixin Device
 */
class DeviceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Device $device) {
            return new DeviceResource($device);
        });
    }
}
