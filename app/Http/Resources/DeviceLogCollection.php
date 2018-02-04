<?php

namespace App\Http\Resources;

use App\Entities\DeviceLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
