<?php

namespace SmartHome\Domain\Mqtt\Router;

class CompiledRoute
{
    /**
     * @var \Symfony\Component\Routing\CompiledRoute
     */
    private $route;

    /**
     * @param \Symfony\Component\Routing\CompiledRoute $route
     */
    public function __construct(\Symfony\Component\Routing\CompiledRoute $route)
    {
        $this->route = $route;
    }

    /**
     * Returns the regex.
     *
     * @return string The regex
     */
    public function getRegex()
    {
        return $this->route->getRegex();
    }
}