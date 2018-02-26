<?php

namespace SmartHome\Domain\Mqtt\Providers;

use SmartHome\Domain\Mqtt\Contracts\Client as ClientContract;
use SmartHome\Domain\Mqtt\Contracts\Router as RouterContract;
use SmartHome\Domain\Mqtt\Client;
use SmartHome\Domain\Mqtt\Router;
use Illuminate\Support\ServiceProvider;

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
