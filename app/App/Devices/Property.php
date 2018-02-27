<?php

namespace SmartHome\App\Devices;

use SmartHome\App\Helpers\HasName;
use SmartHome\Domain\Mqtt\Contracts\Client;
use Illuminate\Validation\Concerns\ValidatesAttributes;
use Psr\Log\LoggerInterface;
use SmartHome\App\Contracts\DeviceProperty as DevicePropertyContract;
use SmartHome\Domain\Devices\Entities\DeviceProperty;

abstract class Property implements DevicePropertyContract
{
    use ValidatesAttributes, HasName;

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
    public function commands(): array
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
     * @return array
     */
    public function meta(): array
    {
        return [];
    }

    /**
     * @param mixed $value
     * @return mixed
     */
    public function format($value)
    {
        return $value;
    }

    public function event()
    {
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

    protected function getLangKey(): string
    {
        return 'properties';
    }
}