<?php

namespace Tests\Unit\Services\OpenWeather;

use Cmfcmf\OpenWeatherMap\CurrentWeather;
use Illuminate\Support\Facades\Event;
use SmartHome\Domain\Weather\Console\Commands\SyncWeather;
use SmartHome\Domain\Weather\Contracts\OpenWeatherMap;
use SmartHome\Domain\Weather\Events\WeatherUpdated;
use SmartHome\Domain\Weather\Weather;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery as m;

class SyncWeatherTest extends TestCase
{
    use RefreshDatabase;

    function test_handle_sync_weather_command()
    {
        $command = new SyncWeather();

        $client = m::mock(OpenWeatherMap::class);

        Event::fake([
            WeatherUpdated::class
        ]);

        $this->app->make('config')->set('services.openweathermap.units', 'test_unit');
        $this->app->make('config')->set('app.locale', 'test_locale');

        $weather = $this->getWeatherData();
        $client->shouldReceive('getWeather')->with('Test', 'test_unit', 'test_locale')->andReturn($weather);

        $this->app->singleton(OpenWeatherMap::class, function () use($client) {
            return $client;
        });

        $command->setLaravel($this->app);

        $command->run(
            new StringInput('Test'),
            new NullOutput()
        );

        Event::assertDispatched(WeatherUpdated::class, function ($e) {
            return $e->weather instanceof Weather;
        });

        $this->assertDatabaseHas((new Weather)->getTable(), [
            'icon' => $weather->weather->icon,
            'temp' => $weather->temperature->now->getValue(),
            'humidity' => $weather->humidity->getValue(),
            'pressure' => $weather->pressure->getValue(),
            'clouds' => $weather->clouds->getValue(),
            'clouds_description' => $weather->clouds->getDescription(),
            'weather_id' => $weather->weather->id,
            'weather_description' => $weather->weather->description
        ]);
    }

    /**
     * @return CurrentWeather
     */
    protected function getWeatherData()
    {
        $data =  new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n
<current><city id=\"524901\" name=\"Moscow\"><coord lon=\"37.62\" lat=\"55.75\"></coord><country>RU</country><sun rise=\"2018-02-24T04:31:25\" set=\"2018-02-24T14:54:47\"></sun></city><temperature value=\"-11.46\" min=\"-13\" max=\"-10\" unit=\"metric\"></temperature><humidity value=\"84\" unit=\"%\"></humidity><pressure value=\"1025\" unit=\"hPa\"></pressure><wind><speed value=\"5\" name=\"Gentle Breeze\"></speed><gusts></gusts><direction value=\"20\" code=\"NNE\" name=\"North-northeast\"></direction></wind><clouds value=\"90\" name=\"пасмурно\"></clouds><visibility value=\"6000\"></visibility><precipitation mode=\"no\"></precipitation><weather number=\"600\" value=\"небольшой снегопад\" icon=\"13n\"></weather><lastupdate value=\"2018-02-24T19:00:00\"></lastupdate></current>");

        return new CurrentWeather($data, 'test_unit');
    }
}
