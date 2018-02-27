<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Events;

use SmartHome\Domain\Xiaomi\MiHome\Gateway\Hub;

class Looping
{
    /**
     * @var Hub
     */
    public $hub;

    /**
     * @param Hub $hub
     */
    public function __construct(Hub $hub)
    {
        $this->hub = $hub;
    }
}