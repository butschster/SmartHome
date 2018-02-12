<?php

namespace App\Http\Controllers\Api;

use App\Entities\MqttLog;
use App\Http\Resources\MqttLogCollection;
use App\Http\Controllers\Controller;

class MqttController extends Controller
{
    /**
     * @return MqttLogCollection
     */
    public function logs(): MqttLogCollection
    {
        return new MqttLogCollection(
            MqttLog::latest()->paginate()
        );
    }
}
