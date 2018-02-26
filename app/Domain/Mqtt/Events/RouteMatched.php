<?php

namespace SmartHome\Domain\Mqtt\Events;

use SmartHome\Domain\Mqtt\Router\Route;

class RouteMatched
{

    /**
     * @var Route
     */
    public $route;

    /**
     * @param Route $route
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }
}