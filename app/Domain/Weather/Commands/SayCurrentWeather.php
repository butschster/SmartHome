<?php

namespace SmartHome\Domain\Weather\Commands;

use SmartHome\Domain\Bot\Contracts\Sayable;
use SmartHome\Domain\Weather\Weather;
use SmartHome\Domain\Bot\Exceptions\SayableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SayCurrentWeather implements Sayable
{
    /**
     * @var string
     */
    protected $say;

    public function handle()
    {
        try {
            $weather = $this->getLastWeatherData();
        } catch (ModelNotFoundException $e) {
            throw new SayableException('На данный момент у меня нет данных о погоде. Спросите позже.');
        }

        $this->say = sprintf(
            'Температура %d градусов. Влажность %d процентов. %s. %s.',
            $weather->temp,
            $weather->humidity,
            $weather->clouds_description,
            $weather->weather_description
        );
    }

    /**
     * @return string
     */
    public function say(): string
    {
        return $this->say;
    }

    /**
     * @return Weather
     */
    protected function getLastWeatherData(): Weather
    {
        return  Weather::latest()->firstOrFail();
    }
}