<?php

namespace App\Http\Resources;

use App\Entities\DevicePropertyLog;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
                'time' => (int) ($log->created_at->timestamp.'000'),
                'value' => $log->value
            ];
        })->toArray();
    }
}
