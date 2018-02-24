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
     * @param Response $response
     * @return string
     * @throws RouteNotFoundException
     */
    public function dispatch(Response $response);

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  Response $response
     * @return mixed
     * @throws RouteNotFoundException
     */
    public function dispatchToRoute(Response $response);

    /**
     * @return RouteCollection
     */
    public function getRoutes(): RouteCollection;

    /**
     * @param string $namespace
     */
    public function namespace(string $namespace): void;
}