<?php

namespace App\Console\Commands;

use App\Contracts\Mqtt\Client as ClientContract;
use App\Exceptions\MqttRouteNotFoundException;
use App\Contracts\Mqtt\Router as RouterContract;
use App\Mqtt\Response;
use Illuminate\Console\Command;

class ListenMqtt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt:listen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @param ClientContract $client
     * @param RouterContract $router
     * @return mixed
     */
    public function handle(ClientContract $client, RouterContract $router)
    {
        $client->listen(function ($topic, $message) use($router) {
            $this->info(sprintf('Message: %s => %s', $topic, $message));

            try {
                $router->dispatch(new Response($topic, $message));
            } catch (MqttRouteNotFoundException $e) {
                $this->error(sprintf('Route for topic: %s not found', $topic));
            }
        });
    }
}
