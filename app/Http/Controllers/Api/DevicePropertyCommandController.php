<?php

namespace App\Http\Controllers\Api;

use App\Entities\DeviceProperty;
use App\Exceptions\DevicePropertyCommandNotFound;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
