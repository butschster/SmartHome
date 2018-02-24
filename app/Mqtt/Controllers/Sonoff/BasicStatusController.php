<?php

namespace SmartHome\Mqtt\Controllers\Sonoff;

use SmartHome\Domain\Mqtt\Contracts\Response;
use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\Domain\Devices\Entities\Device;

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
     * @throws \SmartHome\Domain\Mqtt\Exceptions\UnknownDeviceException
     */
    public function result(Response $response, string $type, string $device)
    {
        $device = Device::register($device, $type);
        $device->setProperties($response->toArray());

        event(new \SmartHome\Domain\Devices\Events\Device\Ping($device));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));
    }
}