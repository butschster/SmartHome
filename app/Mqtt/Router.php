<?php

namespace App\Mqtt;

use App\Contracts\Mqtt\Response;
use App\Contracts\Mqtt\Router as RouterContract;
use Closure;
use Illuminate\Container\Container;

class Router implements RouterContract
{
    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * The route collection instance.
     *
     * @var RouteCollection
     */
    protected $routes;

    /**
     * The globally available parameter patterns.
     *Router
     * @var array
     */
    protected $patterns = [
        'device' => '[0-9a-zA-Z_]+'
    ];

    /**
     * @var string
     */
    protected $namespace = '';

    /**
     * @param  \Illuminate\Container\Container $container
     * @return void
     */
    public function __construct(Container $container = null)
    {
        $this->routes = new RouteCollection;
        $this->container = $container ?: new Container;
    }

    /**
     * @param  string $route
     * @param  Closure|array|string|null $action
     * @return Route
     */
    public function listen(string $route, $action = null): Route
    {
        return $this->addRoute($route, $action);
    }

    /**
     * Dispatch the request to the application.
     *
     * @param Response $response
     * @return string
     * @throws \App\Exceptions\MqttRouteNotFoundException
     */
    public function dispatch(Response $response)
    {
        return $this->dispatchToRoute($response);
    }

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param  Response $response
     * @return mixed
     * @throws \App\Exceptions\MqttRouteNotFoundException
     */
    public function dispatchToRoute(Response $response)
    {
        return $this->runRoute($response, $this->findRoute($response));
    }

    /**
     * Find the route matching a given request.
     *
     * @param  Response $response
     * @return Route
     * @throws \App\Exceptions\MqttRouteNotFoundException
     */
    protected function findRoute(Response $response): Route
    {
        $route = $this->routes->match($response);

        $this->container->instance(Route::class, $route);

        return $route;
    }

    /**
     * Return the response for the given route.
     *
     * @param  Response $response
     * @param  Route $route
     * @return mixed
     */
    protected function runRoute(Response $response, Route $route)
    {
        return $route->run();
    }

    /**
     * @param  string $route
     * @param  Closure|array|string|null $action
     * @return Route
     */
    protected function addRoute(string $route, $action)
    {
        return $this->routes->add($this->createRoute($route, $action));
    }

    /**
     * Create a new route instance.
     *
     * @param  string $route
     * @param  mixed $action
     * @return Route
     */
    protected function createRoute(string $route, $action)
    {
        // If the route is routing to a controller we will parse the route action into
        // an acceptable array format before registering it and creating this route
        // instance itself. We need to build the Closure that will call this out.
        if ($this->actionReferencesController($action)) {
            $action = $this->convertToControllerAction($action);
        }

        $route = $this->newRoute($route, $action);

        $this->addWhereClausesToRoute($route);

        return $route;
    }

    /**
     * Determine if the action is routing to a controller.
     *
     * @param  array $action
     * @return bool
     */
    protected function actionReferencesController($action)
    {
        if (!$action instanceof Closure) {
            return is_string($action) || (isset($action['uses']) && is_string($action['uses']));
        }

        return false;
    }

    /**
     * Add a controller based route action to the action array.
     *
     * @param  array|string $action
     * @return array
     */
    protected function convertToControllerAction($action)
    {
        if (is_string($action)) {
            $action = ['uses' => $action];
        }

        // Here we'll merge any group "uses" statement if necessary so that the action
        // has the proper clause for this property. Then we can simply set the name
        // of the controller on the action and return the action array for usage.
        if (!empty($this->namespace)) {
            $action['uses'] = $this->prependNamespace($action['uses']);
        }

        // Here we will set this controller name on the action array just so we always
        // have a copy of it for reference if we need it. This can be used while we
        // search for a controller name or do some other type of fetch operation.
        $action['controller'] = $action['uses'];

        return $action;
    }

    /**
     * Prepend the last group namespace onto the use clause.
     *
     * @param  string $class
     * @return string
     */
    protected function prependNamespace($class)
    {
        return strpos($class, '\\') !== 0
            ? rtrim($this->namespace, '\\') . '\\' . $class : $class;
    }

    /**
     * Create a new Route object.
     *
     * @param  string $route
     * @param  mixed $action
     * @return Route
     */
    protected function newRoute(string $route, $action)
    {
        return (new Route($route, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }

    /**
     * Add the necessary where clauses to the route based on its initial registration.
     *
     * @param  Route $route
     * @return Route
     */
    protected function addWhereClausesToRoute($route)
    {
        $route->where(array_merge(
            $this->patterns, $route->getAction()['where'] ?? []
        ));

        return $route;
    }

    /**
     * @return RouteCollection
     */
    public function getRoutes(): RouteCollection
    {
        return $this->routes;
    }

    /**
     * @param string $namespace
     */
    public function namespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }
}