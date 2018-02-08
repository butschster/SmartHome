<?php

namespace App\Http\Controllers\Api;

use App\Entities\Weather;
use App\Http\Controllers\Controller;
use App\Http\Resources\WearherResource;

class WeatherController extends Controller
{
    /**
     * Получение текущей погоды
     *
     * @return WearherResource
     */
    public function show()
    {
        return new WearherResource(
            Weather::latest()->firstOrFail()
        );
    }
}
