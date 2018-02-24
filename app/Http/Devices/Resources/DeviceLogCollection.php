<?php

namespace SmartHome\Http\Devices\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use SmartHome\Domain\Devices\Entities\DeviceLog;

/**
 * @mixin DeviceLog
 */
class DeviceLogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
