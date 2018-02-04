<?php

namespace App\Providers;

use App\Contracts\Services\OpenWeatherMap as OpenWeatherMapContract;
use App\Services\OpenWeatherMap\Client;
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
            $config = $app['config']->get('services.openweathermap');

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
