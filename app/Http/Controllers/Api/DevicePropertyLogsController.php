<?php

namespace App\Http\Controllers\Api;

use App\Entities\DeviceProperty;
use App\Http\Controllers\Controller;
use App\Http\Resources\DevicePropertyLogsCollection;
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
