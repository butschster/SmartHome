<?php

namespace SmartHome\Domain\Mqtt\Contracts;

use SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException;
use SmartHome\Domain\Mqtt\Router\Route;
use SmartHome\Domain\Mqtt\Router\RouteCollection;

interface Router
{
    /**
     * @param  string $route
     * @param  \Closure|array|string|null $action
     * @return Route
     */
    public function listen(string $route, $action = null): Route;

    /**
     * Dispatch the request to the application.
     *
     * @param Request $response
     * @return string
     * @throws RouteNotFoundException
     */
    public function dispatch(Request $response);

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  Request $response
     * @return mixed
     * @throws RouteNotFoundException
     */
    public function dispatchToRoute(Request $response);

    /**
     * @return RouteCollection
     */
    public function getRoutes(): RouteCollection;

    /**
     * @param string $namespace
     */
    public function namespace(string $namespace): void;
}