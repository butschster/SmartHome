<?php

namespace App\Mqtt\Router;

use Symfony\Component\Routing\Route as SymfonyRoute;

class RouteCompiler
{
    /**
     * The route instance.
     *
     * @var Route
     */
    protected $route;

    /**
     * Create a new Route compiler instance.
     *
     * @param  Route $route
     * @return void
     */
    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * Compile the route.
     *
     * @return CompiledRoute
     */
    public function compile(): CompiledRoute
    {
        $optionals = $this->getOptionalParameters();

        $message = preg_replace('/\{(\w+?)\?\}/', '{$1}', $this->route->message());

        return new CompiledRoute(
            (new SymfonyRoute($message, $optionals, $this->route->wheres, [], ''))->compile()
        );
    }

    /**
     * Get the optional parameters for the route.
     *
     * @return array
     */
    protected function getOptionalParameters(): array
    {
        preg_match_all('/\{(\w+?)\?\}/', $this->route->message(), $matches);

        return isset($matches[1]) ? array_fill_keys($matches[1], null) : [];
    }
}