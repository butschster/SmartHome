<?php

namespace SmartHome\Domain\Mqtt\Providers;

use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\Domain\Mqtt\Contracts\Client as ClientContract;
use SmartHome\Domain\Mqtt\Contracts\Router as RouterContract;
use SmartHome\Domain\Mqtt\Client;
use SmartHome\Domain\Mqtt\Router;
use Illuminate\Support\ServiceProvider;

class MqttServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $middleware = [
        \SmartHome\Domain\Mqtt\Middleware\RegisterDevice::class,
        \SmartHome\Domain\Mqtt\Middleware\LogMessages::class
    ];

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
            $router = new Router($app, $app[Dispatcher::class]);

            require base_path('routes/mqtt.php');

            return $router;
        });

        $this->registerMiddleware();
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

    protected function registerMiddleware(): void
    {
        foreach ($this->middleware as $class) {
            Router::registerMiddleware($class);
        }
    }
}
