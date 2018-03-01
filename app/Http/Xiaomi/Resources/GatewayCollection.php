<?php

namespace SmartHome\Http\Xiaomi\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use SmartHome\Domain\Xiaomi\Entities\Gateway;

class GatewayCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (Gateway $gateway) {
            return new GatewayResource($gateway);
        });
    }
}
