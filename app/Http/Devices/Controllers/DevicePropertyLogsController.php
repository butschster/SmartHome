<?php

namespace SmartHome\Http\Devices\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Http\Devices\Resources\DevicePropertyLogsCollection;
use Illuminate\Http\Request;

class DevicePropertyLogsController extends Controller
{
    /**
     * @param Request $request
     * @param DeviceProperty $property
     * @return DevicePropertyLogsCollection
     */
    public function index(Request $request, DeviceProperty $property)
    {
        $request->validate([
            'from' => 'nullable|date',
            'to' => 'nullable|date|after:from'
        ]);

        $logs = $property->logs()->whereBetween('created_at', [
            $request->input('from', now()->startOfDay()->toDateTimeString()),
            $request->input('to', now()->endOfDay()->toDateTimeString()),
        ])->get();

        return new DevicePropertyLogsCollection($logs);
    }
}
