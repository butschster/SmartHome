<?php

namespace SmartHome\Domain\Mqtt\Contracts;

use Illuminate\Contracts\Support\Arrayable;
use SmartHome\Domain\Mqtt\Router\Route;

interface Request extends Arrayable
{
    /**
     * @return string
     */
    public function getRoute(): string;

    /**
     * @return string
     */
    public function getPayload(): string;

    /**
     * Determine a given parameter exists from the route.
     *
     * @param  string $name
     * @return bool
     */
    public function hasParameter($name): bool;

    /**
     * Get a given parameter from the route.
     *
     * @param  string  $name
     * @param  mixed   $default
     * @return string|object
     */
    public function parameter($name, $default = null);

    /**
     * Set a parameter to the given value.
     *
     * @param  string  $name
     * @param  mixed   $value
     * @return void
     */
    public function setParameter($name, $value): void;

    /**
     * Unset a parameter on the route if it is set.
     *
     * @param  string  $name
     * @return void
     */
    public function forgetParameter($name): void;

    /**
     * Get the route handling the request.
     *
     * @param  string|null  $param
     *
     * @return Route|object|string
     */
    public function route($param = null);
}