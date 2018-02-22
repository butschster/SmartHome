<?php

namespace Tests\Helpers;

use App\Contracts\Mqtt\Client;
use App\Contracts\Mqtt\DevicePropertyLoggable;
use App\Contracts\Switchable;
use Psr\Log\LoggerInterface;
use Mockery as m;
use App\Contracts\Mqtt\DeviceProperty as DevicePropertyContract;

trait PropertyActionsTrait
{
    /**
     * @param string $class
     * @param Client|null $client
     * @param LoggerInterface|null $logger
     * @return DevicePropertyContract
     */
    public function makePropertyAction(string $class, Client $client = null, LoggerInterface $logger = null): DevicePropertyContract
    {
        return new $class(
            $client ?: m::mock(Client::class),
            $logger ?: m::mock(LoggerInterface::class)
        );
    }

    public function assertLoggablePropertyAction(DevicePropertyContract $property)
    {
        $this->assertInstanceOf(DevicePropertyLoggable::class, $property);
    }

    public function assertSwitchablePropertyAction(DevicePropertyContract $property)
    {
        $this->assertInstanceOf(Switchable::class, $property);
    }
}