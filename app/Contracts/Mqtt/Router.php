<?php

namespace App\Contracts\Mqtt;

use App\Mqtt\Route;
use App\Mqtt\RouteCollection;

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
     * @throws \App\Exceptions\MqttRouteNotFoundException
     */
    public function dispatch(Response $response);

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  Response $response
     * @return mixed
     * @throws \App\Exceptions\MqttRouteNotFoundException
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