<?php

namespace App\Providers;

use App\Contracts\Mqtt\Client as ClientContract;
use App\Contracts\Mqtt\Router as RouterContract;
use App\Mqtt\Client;
use App\Mqtt\DeviceManager;
use App\Mqtt\Router;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Mqtt\DeviceManager as DeviceManagerContract;

class MqttServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(ClientContract::class, function ($app) {
            $config = $this->app->make('config')->get('mqtt');

            $mqttClient = new \Bluerhinos\phpMQTT(
                $config['host'],
                $config['port'],
                $config['client_id']
            );

            return new Client(
                $mqttClient,
                array_except($config, ['host', 'port', 'client_id'])
            );
        });

        $this->app->singleton(DeviceManagerContract::class, function ($app) {
            return new DeviceManager($app);
        });

        $this->app->singleton(RouterContract::class, function ($app) {
            $router = new Router($app);

            require base_path('routes/mqtt.php');

            return $router;
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
