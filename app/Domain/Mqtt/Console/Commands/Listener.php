<?php

namespace SmartHome\Domain\Mqtt\Console\Commands;

use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\Domain\Mqtt\Contracts\Client;
use SmartHome\Domain\Mqtt\Contracts\Request as RequestContract;
use SmartHome\Domain\Mqtt\Events\MessageReceived;
use SmartHome\Domain\Mqtt\Contracts\Router;
use SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException;
use SmartHome\App\Exceptions\UnknownDeviceException;
use SmartHome\Domain\Mqtt\Router\Request;
use Illuminate\Console\Command;

class Listener extends Command
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
     * @var Client
     */
    protected $client;

    /**
     * @var Router
     */
    protected $router;
    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Client $client
     * @param Router $router
     * @param Dispatcher $events
     */
    public function __construct(Client $client, Router $router, Dispatcher $events)
    {
        parent::__construct();

        $this->client = $client;
        $this->router = $router;
        $this->events = $events;
    }

    public function handle()
    {
        $this->client->setClientId('SmartHomeListener');

        $this->client->listen(function ($topic, $message) {
            $this->info(sprintf('[%s] Message: %s => %s', now()->toDateTimeString(), $topic, $message));

            $this->events->dispatch(new MessageReceived($topic, $message));

            $this->precessMessage($topic, $message);
        });
    }

    /**
     * @param string $topic
     * @param $message
     */
    protected function precessMessage(string $topic, $message)
    {
        try {
            $this->process($topic, $message);
        } catch (RouteNotFoundException $e) {
            $this->error(sprintf('[%s] Info: route for topic [%s] not found', now()->toDateTimeString(), $topic));
        } catch (UnknownDeviceException $e) {
            $this->error(sprintf('[%s] Error: unknown device [%s]', now()->toDateTimeString(), $e->getMessage()));
        } catch (\Exception $e) {
            $this->error(sprintf('[%s] Error: %s', now()->toDateTimeString(), $e->getMessage()));
        }
    }

    /**
     * @param string $topic
     * @param $message
     * @throws RouteNotFoundException
     */
    protected function process(string $topic, $message): void
    {
        $this->laravel->instance(
            RequestContract::class,
            $request = new Request($topic, $message)
        );

        $this->router->dispatch($request);
    }

    /**
     * Get the route dispatcher callback.
     *
     * @return \Closure
     */
    protected function dispatchToRouter()
    {
        return function ($response) {
            return $this->router->dispatch($response);
        };
    }
}
