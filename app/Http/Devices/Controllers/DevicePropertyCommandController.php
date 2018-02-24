<?php

namespace SmartHome\Http\Devices\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Domain\Devices\Exceptions\DevicePropertyCommandNotFound;
use Illuminate\Http\Request;

class DevicePropertyCommandController extends Controller
{
    /**
     * @param Request $request
     * @param DeviceProperty $property
     * @param string $command
     * @return array
     */
    public function invoke(Request $request, DeviceProperty $property, string $command)
    {
        $request->validate([
            'parameters' => 'nullable|array'
        ]);

        try {
            $property->runCommand($command, $request->input('parameters', []));
        } catch (DevicePropertyCommandNotFound $e) {
            return response_error();
        }

        return response_ok();
    }
}
