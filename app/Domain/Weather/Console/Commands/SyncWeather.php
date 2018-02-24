<?php

namespace SmartHome\Domain\Weather\Console\Commands;

use SmartHome\Domain\Weather\Contracts\OpenWeatherMap;
use SmartHome\Domain\Weather\Exceptions\OpenWeatherMapRequestException;
use SmartHome\Domain\Weather\Weather;
use Illuminate\Console\Command;

class SyncWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:sync {city?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Получение данных о погоде от сервиса OpenWeatherMap';

    /**
     * @param OpenWeatherMap $weather
     * @throws OpenWeatherMapRequestException
     */
    public function handle(OpenWeatherMap $weather)
    {
        $config = config('services.openweathermap');
        $city = $this->argument('city') ?: $config['city'];

        try {
            $response = $weather->getWeather($city, $config['units'], config('app.locale'));

            Weather::create([
                'icon' => $response->weather->icon,
                'temp' => $response->temperature->now->getValue(),
                'humidity' => $response->humidity->getValue(),
                'pressure' => $response->pressure->getValue(),
                'clouds' => $response->clouds->getValue(),
                'clouds_description' => $response->clouds->getDescription(),
                'weather_id' => $response->weather->id,
                'weather_description' => $response->weather->description
            ]);
        } catch (\Exception $e) {
            throw new OpenWeatherMapRequestException($e->getMessage());
        }
    }
}
