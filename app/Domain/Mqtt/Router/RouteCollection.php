<?php

namespace SmartHome\Domain\Mqtt\Router;

use SmartHome\Domain\Mqtt\Contracts\Request;
use Countable;
use ArrayIterator;
use IteratorAggregate;
use SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException;

class RouteCollection implements Countable, IteratorAggregate
{
    /**
     * An array of the routes keyed by method.
     *
     * @var array
     */
    protected $routes = [];

    /**
     * Add a Route instance to the collection.
     *
     * @param  Route $route
     * @return Route
     */
    public function add(Route $route)
    {
        $this->addToCollections($route);

        return $route;
    }

    /**
     * Add the given route to the arrays of routes.
     *
     * @param  Route $route
     * @return void
     */
    protected function addToCollections(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @param Request $request
     * @return Route
     *
     * @throws RouteNotFoundException
     */
    public function match(Request $request): Route
    {
        $route = $this->matchAgainstRoutes($this->routes, $request);

        if (!is_null($route)) {
            return $route->bind($request);
        }

        throw new RouteNotFoundException();
    }

    /**'OFF'
     * Determine if a route in the array matches the request.
     *
     * @param  array|Route[] $routes
     * @param  Request $request
     * @return Route|null
     */
    protected function matchAgainstRoutes(array $routes, Request $request)
    {
        list($fallbacks, $routes) = collect($routes)->partition(function ($route) {
            return $route->isFallback;
        });

        return $routes->merge($fallbacks)->first(function ($value) use ($request) {
            return $value->matches($request);
        });
    }

    /**
     * Get an iterator for the items.
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new ArrayIterator($this->getRoutes());
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count()
    {
        return count($this->getRoutes());
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }
}