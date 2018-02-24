<?php

namespace SmartHome\Http\Mqtt\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MqttLogCollection extends ResourceCollection
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
