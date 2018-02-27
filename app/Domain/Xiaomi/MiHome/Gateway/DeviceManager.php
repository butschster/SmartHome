<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway;

use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\App\Exceptions\UnknownDeviceException;
use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Events\Device\Ping;
use SmartHome\Domain\Mqtt\Events\UnknownDevice;
use SmartHome\Domain\Xiaomi\Entities\Gateway;

class DeviceManager
{
    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * @param Message $message
     * @return bool
     */
    public function isValidMessage(Message $message)
    {
        return $message->isTypeOf('report', 'hearbeat', 'read_ack');
    }

    /**
     * @param Message $message
     * @throws \SmartHome\App\Exceptions\UnknownDeviceException
     */
    public function processMessage(Message $message)
    {
        $gateway = $this->findOrCreateGateway($message->ip());

        $this->registerDevice(
            $gateway,
            $message->sid(),
            $message->model(),
            $message->parameters()
        );
    }

    /**
     * @param string $ip
     * @return Gateway
     */
    private function findOrCreateGateway(string $ip): Gateway
    {
        return Gateway::firstOrCreate([
            'ip' => $ip
        ]);
    }

    /**
     * Регистрация нового устройства
     *
     * @param Gateway $gateway
     * @param string $sid
     * @param string $device
     * @param array $parameters
     */
    private function registerDevice(Gateway $gateway, string $sid, string $device, array $parameters)
    {
        $type = 'xiaomi_' . $device;

        try {
            $device = Device::register($sid, $type);
            $device->setProperties($parameters);

            if (!$gateway->devices()->find($device->id)) {
                $gateway->devices()->attach($device);
            }

            $this->events->dispatch(new Ping($device));
        } catch (UnknownDeviceException $e) {
            $this->events->dispatch(new UnknownDevice(
                $sid,
                $type
            ));
        }
    }
}