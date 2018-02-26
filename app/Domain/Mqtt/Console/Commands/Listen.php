<?php

namespace SmartHome\Domain\Mqtt\Console\Commands;

use SmartHome\Domain\Mqtt\Contracts\Client as ClientContract;
use SmartHome\Domain\Mqtt\Events\Message;
use SmartHome\Domain\Mqtt\Contracts\Router as RouterContract;
use SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException;
use SmartHome\App\Exceptions\UnknownDeviceException;
use SmartHome\Domain\Mqtt\Router\Response;
use Illuminate\Console\Command;

class Listen extends Command
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
    protected $description = 'Запуск клиента MQTT';

    /**
     * Execute the console command.
     *
     * @param ClientContract $client
     * @param RouterContract $router
     * @return mixed
     */
    public function handle(ClientContract $client, RouterContract $router)
    {
        $client->setClientId('SmartHomeListener');

        $client->listen(function ($topic, $message) use ($router) {
            $this->info(sprintf('[%s] Message: %s => %s', now()->toDateTimeString(), $topic, $message));

            event(new Message($topic, $message));

            try {
                $router->dispatch(new Response($topic, $message));
            } catch (RouteNotFoundException $e) {
                $this->error(sprintf('[%s] Info: route for topic [%s] not found', now()->toDateTimeString(), $topic));
            } catch (UnknownDeviceException $e) {
                $this->error(sprintf('[%s] Error: unknown device [%s]', now()->toDateTimeString(), $e->getMessage()));
            } catch (\Exception $e) {
                $this->error(sprintf('[%s] Error: %s', now()->toDateTimeString(), $e->getMessage()));
            }
        });
    }
}
