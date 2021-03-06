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
        return $message->isTypeOf('report', 'heartbeat', 'read_ack');
    }

    /**
     * @param Message $message
     */
    public function processMessage(Message $message)
    {
        if ($message->isTypeOf('heartbeat') && $message->model() == 'gateway') {
            $this->registerGateway($message->ip(), $message->sid(), $message->token());
        }

        $gateway = Gateway::where('ip', $message->ip())->first();

        if ($gateway) {
            $this->registerDevice(
                $gateway,
                $message->sid(),
                $message->model(),
                $message->parameters()
            );
        }
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

    /**
     * @param string $ip
     * @param string $sid
     * @param string $token
     */
    private function registerGateway(string $ip, string $sid, string $token)
    {
        $gateway = Gateway::firstOrCreate(['ip' => $ip], ['sid' => $sid]);

        $gateway->update(['token' => $token]);
    }
}