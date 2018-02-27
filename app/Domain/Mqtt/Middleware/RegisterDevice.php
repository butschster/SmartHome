<?php

namespace SmartHome\Domain\Mqtt\Middleware;

use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\App\Exceptions\UnknownDeviceException;
use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Events\Device\Ping;
use SmartHome\Domain\Mqtt\Contracts\Request;
use SmartHome\Domain\Mqtt\Events\UnknownDevice;

class RegisterDevice
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
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $route = $request->route();

        if ($route->hasParameter('type') && $route->hasParameter('device')) {
            try {
                $device = Device::register($route->parameter('device'), $route->parameter('type'));
                $route->setParameter('registeredDevice', $device);

                $this->events->dispatch(new Ping($device));
            } catch (UnknownDeviceException $e) {
                $this->events->dispatch(new UnknownDevice(
                    $route->parameter('device'),
                    $route->parameter('type')
                ));
            }
        }

        return $next($request);
    }
}