<?php

namespace App\Http\Controllers\Api;

use App\Entities\DeviceProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevicePropertyCommandController extends Controller
{
    /**
     * @param Request $request
     * @param DeviceProperty $property
     * @param string $command
     */
    public function invoke(Request $request, DeviceProperty $property, string $command)
    {
        $request->validate([
            'parameters' => 'nullable|array'
        ]);

        $property->runCommand($command, $request->input('parameters', []));
    }
}
