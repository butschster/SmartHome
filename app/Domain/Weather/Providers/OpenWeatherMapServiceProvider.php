<?php

namespace SmartHome\Domain\Weather\Providers;

use SmartHome\Domain\Weather\Client;
use SmartHome\Domain\Weather\Contracts\OpenWeatherMap as OpenWeatherMapContract;
use Illuminate\Support\ServiceProvider;

class OpenWeatherMapServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(OpenWeatherMapContract::class, function ($app) {

            $config = $this->app->make('config')
                ->get('services.openweathermap');

            return new Client($config['key']);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
