<?php

namespace SmartHome\Http\Weather\Controllers;

use SmartHome\App\Http\Controller;
use SmartHome\Domain\Weather\Weather;
use SmartHome\Http\Weather\Resources\WearherResource;

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
