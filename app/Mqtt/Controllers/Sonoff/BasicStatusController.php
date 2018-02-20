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
     * @throws \App\Exceptions\UnknownDeviceException
     */
    public function result(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);
        $device->setProperties($response->toArray());

        event(new \App\Events\Device\Ping($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}