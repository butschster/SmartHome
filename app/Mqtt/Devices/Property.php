<?php

namespace App\Mqtt\Devices;

use App\Contracts\Mqtt\Client;
use App\Entities\DeviceProperty;
use Psr\Log\LoggerInterface;
use App\Contracts\Mqtt\DeviceProperty as DevicePropertyContract;

abstract class Property implements DevicePropertyContract
{
    /**
     * @var array
     */
    protected $commands = [];

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var DeviceProperty
     */
    protected $deviceProperty;

    /**
     * @param Client $client
     * @param LoggerInterface $logger
     */
    public function __construct(Client $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    /**
     * @param DeviceProperty $deviceProperty
     */
    public function setDeviceProperty(DeviceProperty $deviceProperty): void
    {
        $this->deviceProperty = $deviceProperty;
    }

    /**
     * @return array
     */
    public function getCommands(): array
    {
        return array_combine($this->commands, $this->commands);
    }

    /**
     * @param string $message
     */
    public function runCommand(string $message): void
    {
        $this->client->publish($this->createTopic($this->deviceProperty), $message);
    }

    /**
     * @param DeviceProperty $deviceProperty
     * @return string
     */
    protected function createTopic(DeviceProperty $deviceProperty): string
    {
        return sprintf(
            'cmnd/%s/%s/%s',
            $deviceProperty->device->type,
            $deviceProperty->device->key,
            $deviceProperty->key
        );
    }

    /**
     * @param string $message
     */
    protected function log(string $message): void
    {
        $this->logger->debug(sprintf('Property [%s] %s', $this->deviceProperty->id, $message));
    }
}