<?php

namespace SmartHome\Http\Mqtt\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Mqtt\MqttLog;
use SmartHome\Http\Mqtt\Resources\MqttLogCollection;

class LogsController extends Controller
{
    /**
     * @return MqttLogCollection
     */
    public function index(): MqttLogCollection
    {
        return new MqttLogCollection(
            MqttLog::latest()->paginate()
        );
    }
}
