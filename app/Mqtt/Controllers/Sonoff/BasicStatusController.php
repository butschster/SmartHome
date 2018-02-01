<?php

namespace App\Mqtt\Controllers\Sonoff;

use App\Contracts\Mqtt\Response;
use App\Entities\Device;
use App\Contracts\Device as DeviceContract;
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
     * @param Response $message
     * @param string $device
     */
    public function power(Response $message, string $device)
    {

    }

    /**
     * @param Response $response
     * @param string $device
     */
    public function result(Response $response, string $device)
    {
        $device = Device::getByKey($device, DeviceContract::SOURCE_MQTT, DeviceContract::TYPE_SONOFF_BASIC);

        $payload = $response->toArray();
        $device->setProperties(array_only($payload, ['POWER', 'POWER1', 'POWER2', 'POWER3', 'POWER4']));

        $device->log(sprintf('%s: %s', $response->getRoute(), $response->getPayload()));

        //$this->dispatcher->dispatch(new State($device));
    }
}