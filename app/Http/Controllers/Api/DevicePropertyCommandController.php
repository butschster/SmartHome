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
     * @return array
     */
    public function invoke(Request $request, DeviceProperty $property, string $command): array
    {
        $request->validate([
            'parameters' => 'nullable|array'
        ]);

        $property->runCommand($command, $request->input('parameters', []));

        return response_ok();
    }
}
