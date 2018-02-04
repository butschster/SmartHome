<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;
use Illuminate\Contracts\Events\Dispatcher;

class BasicStatusController
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * Получение результата выполнения команды.
     *
     * @param Response $response
     * @param string $type
     * @param string $device
     */
    public function result(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);

        $payload = $response->toArray();
        $device->setProperties(array_only($payload, ['POWER', 'POWER1', 'POWER2', 'POWER3', 'POWER4']));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));

        //$this->dispatcher->dispatch(new State($device));
    }
}