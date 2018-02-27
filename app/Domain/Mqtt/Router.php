<?php

namespace SmartHome\Domain\Mqtt;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Pipeline\Pipeline;
use SmartHome\Domain\Mqtt\Contracts\Request;
use SmartHome\Domain\Mqtt\Contracts\Router as RouterContract;
use Closure;
use Illuminate\Container\Container;
use SmartHome\Domain\Mqtt\Events\RouteMatched;
use SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException;

class Router implements RouterContract
{
    /**
     * @var array
     */
    protected static $middleware = [];

    /**
     * @param $middleware
     */
    public static function registerMiddleware($middleware)
    {
        static::$middleware[] = $middleware;
    }

    /**
     * @return array
     */
    public static function getMiddleware(): array
    {
        return self::$middleware;
    }

    /**
     * The IoC container instance.
     *
     * @var \Illuminate\Container\Container
     */
    protected $container;

    /**
     * The route collection instance.
     *
     * @var Router\RouteCollection
     */
    protected $routes;

    /**
     * The globally available parameter patterns.
     *Router
     * @var array
     */
    protected $patterns = [
        'device' => '[0-9a-zA-Z_]+',
        'type' => '[a-z_]+'
    ];

    /**
     * @var string
     */
    protected $namespace = '';

    /**
     * @var Dispatcher
     */
    protected $events;

    /**
     * @param Container|null $container
     * @param Dispatcher $events
     */
    public function __construct(Container $container = null, Dispatcher $events)
    {
        $this->routes = new Router\RouteCollection;
        $this->container = $container ?: new Container;
        $this->events = $events;
    }

    /**
     * @param  string $route
     * @param  Closure|array|string|null $action
     * @return Router\Route
     */
    public function listen(string $route, $action = null): Router\Route
    {
        return $this->addRoute($route, $action);
    }

    /**
     * Dispatch the request to the application.
     *
     * @param Request $request
     * @return string
     * @throws RouteNotFoundException
     * @throws \ReflectionException
     */
    public function dispatch(Request $request)
    {
        return $this->dispatchToRoute($request);
    }

    /**
     * Dispatch the request to a route and return the response.
     *
     * @param Request $request
     * @return mixed
     * @throws RouteNotFoundException
     * @throws \ReflectionException
     */
    public function dispatchToRoute(Request $request)
    {
        return $this->runRoute(
            $request,
            $this->findRoute($request)
        );
    }

    /**
     * Find the route matching a given request.
     *
     * @param  Request $request
     * @return Router\Route
     * @throws RouteNotFoundException
     */
    protected function findRoute(Request $request): Router\Route
    {
        $route = $this->routes->match($request);

        $this->container->instance(Router\Route::class, $route);

        return $route;
    }

    /**
     * Return the response for the given route.
     *
     * @param  Request $request
     * @param  Router\Route $route
     * @return mixed
     */
    protected function runRoute(Request $request, Router\Route $route)
    {
        $request->setRouteResolver(function () use ($route) {
            return $route;
        });

        $this->events->dispatch(new RouteMatched($route));

        $middleware = $this->gatherRouteMiddleware($route);

        return (new Pipeline($this->container))
            ->send($request)
            ->through($middleware)
            ->then(function($request) use($route) {
                return $route->run();
            });
    }

    /**
     * Gather the middleware for the given route with resolved class names.
     *
     * @param Router\Route  $route
     * @return array
     */
    public function gatherRouteMiddleware(Router\Route $route): array
    {
        return array_merge(
            $route->gatherMiddleware(),
            static::getMiddleware()
        );
    }

    /**
     * @param  string $route
     * @param  Closure|array|string|null $action
     * @return Router\Route
     */
    protected function addRoute(string $route, $action): Router\Route
    {
        return $this->routes->add($this->createRoute($route, $action));
    }

    /**
     * Create a new route instance.
     *
     * @param  string $route
     * @param  mixed $action
     * @return Router\Route
     */
    protected function createRoute(string $route, $action): Router\Route
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
    protected function actionReferencesController($action): bool
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
    protected function convertToControllerAction($action): array
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
    protected function prependNamespace($class): string
    {
        return strpos($class, '\\') !== 0
            ? rtrim($this->namespace, '\\') . '\\' . $class : $class;
    }

    /**
     * Create a new Route object.
     *
     * @param  string $route
     * @param  mixed $action
     * @return Router\Route
     */
    protected function newRoute(string $route, $action): Router\Route
    {
        return (new Router\Route($route, $action))
            ->setRouter($this)
            ->setContainer($this->container);
    }

    /**
     * Add the necessary where clauses to the route based on its initial registration.
     *
     * @param  Router\Route $route
     * @return Router\Route
     */
    protected function addWhereClausesToRoute(Router\Route $route): Router\Route
    {
        $route->where(array_merge(
            $this->patterns, $route->getAction()['where'] ?? []
        ));

        return $route;
    }

    /**
     * @return Router\RouteCollection
     */
    public function getRoutes(): Router\RouteCollection
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