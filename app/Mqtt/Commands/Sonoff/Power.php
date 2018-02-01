<?php

namespace App\Mqtt\Commands\Sonoff;

use App\Contracts\Mqtt\Client;
use BinSoul\Net\Mqtt\DefaultMessage;

class Power
{
    const TOPIC = 'cmnd/%s/POWER';

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $device
     * @return \React\Promise\ExtendedPromiseInterface
     */
    public function switchOn(string $device)
    {
        return $this->client->publish(
            $this->createTopic($device), 1
        );
    }

    /**
     * @param string $device
     * @return \React\Promise\ExtendedPromiseInterface
     */
    public function switchOff(string $device)
    {
        return $this->client->publish(
            $this->createTopic($device), 0
        );
    }

    /**
     * @param string $device
     * @return string
     */
    protected function createTopic(string $device): string
    {
        return sprintf(static::TOPIC, $device);
    }
}