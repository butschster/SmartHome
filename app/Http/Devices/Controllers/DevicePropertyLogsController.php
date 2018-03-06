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
        if (!$request->has('period')) {
            $request->offsetSet('period', 'year');
        }

        $logs = $property->logs()->filter($request)->get();

        return new DevicePropertyLogsCollection($logs);
    }
}
