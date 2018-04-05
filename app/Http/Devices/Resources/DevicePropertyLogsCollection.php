<?php

namespace SmartHome\Http\Devices\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use SmartHome\Domain\Devices\Entities\DevicePropertyLog;

class DevicePropertyLogsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function (DevicePropertyLog $log) {
            return [
                'time' => $log->created_at->timestamp * 1000,
                'value' => $log->value
            ];
        })->toArray();
    }
}
