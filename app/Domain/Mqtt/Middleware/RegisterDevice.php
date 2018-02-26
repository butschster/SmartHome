<?php

namespace SmartHome\Domain\Mqtt\Middleware;

use Closure;
use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\App\Exceptions\UnknownDeviceException;
use SmartHome\Domain\Devices\Entities\Device;
use SmartHome\Domain\Devices\Events\Device\Ping;
use SmartHome\Domain\Mqtt\Events\UnknownDevice;
use SmartHome\Domain\Mqtt\Router\Route;

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
     * @param Route $route
     * @param Closure $next
     * @return mixed
     */
    public function handle($route, Closure $next)
    {
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

        return $next($route);
    }
}