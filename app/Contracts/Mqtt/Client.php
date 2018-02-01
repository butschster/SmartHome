<?php

namespace App\Contracts\Mqtt;

use Closure;

interface Client
{
    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId);

    /**
     * @param Closure $callback
     */
    public function listen(Closure $callback);

    /**
     * @param string $topic
     * @param string $message
     */
    public function publish(string $topic, $message);
}