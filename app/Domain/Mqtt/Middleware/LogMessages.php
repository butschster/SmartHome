<?php

namespace SmartHome\Domain\Mqtt\Middleware;

use Closure;
use Psr\Log\LoggerInterface;
use SmartHome\Domain\Mqtt\Contracts\Request;

class LogMessages
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        if ($route->hasParameter('registeredDevice')) {
//            $device = $route->parameter('registeredDevice');
//
//            $device->log(sprintf(
//                '%s: %s',
//                $route->parameter('response')->getRoute(),
//                $route->parameter('response')->getPayload()
//            ));
//        }

        return $next($request);
    }
}