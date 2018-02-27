<?php

namespace SmartHome\Domain\Mqtt\Router;

use Closure;
use Illuminate\Support\Arr;
use SmartHome\Domain\Mqtt\Contracts\Request as RequestContract;

class Request implements RequestContract
{
    /**
     * @var string
     */
    protected $topic;

    /**
     * @var array
     */
    protected $parameters = [];

    /**
     * @var string
     */
    protected $payload;

    /**
     * The route resolver callback.
     *
     * @var \Closure
     */
    protected $routeResolver;

    /**
     * @param string $topic
     * @param string $payload
     */
    public function __construct(string $topic, string $payload)
    {
        $this->topic = $topic;
        $this->payload = $payload;
        $this->parameters = $this->decodeMessage($payload);
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getRoute(): string
    {
        return $this->topic;
    }

    /**
     * @return string
     */
    public function getPayload(): string
    {
        return $this->payload;
    }

    /**
     * Determine a given parameter exists from the route.
     *
     * @param  string $name
     * @return bool
     */
    public function hasParameter($name): bool
    {
        return array_key_exists($name, $this->parameters);
    }

    /**
     * Get a given parameter from the route.
     *
     * @param  string  $name
     * @param  mixed   $default
     * @return string|object
     */
    public function parameter($name, $default = null)
    {
        return Arr::get($this->parameters, $name, $default);
    }

    /**
     * Set a parameter to the given value.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @return void
     */
    public function setParameter($name, $value): void
    {
        $this->parameters[$name] = $value;
    }

    /**
     * Unset a parameter on the route if it is set.
     *
     * @param  string  $name
     * @return void
     */
    public function forgetParameter($name): void
    {
        unset($this->parameters[$name]);
    }

    /**
     * Get the route handling the request.
     *
     * @param  string|null  $param
     *
     * @return Route|object|string
     */
    public function route($param = null)
    {
        $route = call_user_func($this->getRouteResolver());

        if (is_null($route) || is_null($param)) {
            return $route;
        }

        return $route->parameter($param);
    }

    /**
     * Get the route resolver callback.
     *
     * @return Closure
     */
    public function getRouteResolver()
    {
        return $this->routeResolver ?: function () {
            //
        };
    }

    /**
     * Set the route resolver callback.
     *
     * @param  Closure  $callback
     * @return $this
     */
    public function setRouteResolver(Closure $callback)
    {
        $this->routeResolver = $callback;

        return $this;
    }

    /**
     * @param string $message
     * @return array
     */
    protected function decodeMessage(string $message)
    {
        $array = json_decode($message, true);

        if (!$array && json_last_error_msg()) {
            return [$message];
        }

        return $array;
    }
}