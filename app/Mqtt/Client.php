<?php

namespace App\Mqtt;

use App\Contracts\Mqtt\Client as ClientContract;
use Bluerhinos\phpMQTT;
use Closure;

class Client implements ClientContract
{
    /**
     * @var phpMQTT
     */
    private $client;

    /**
     * @param string $host
     * @param int $port
     * @param string|null $clientId
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(
        string $host = 'localhost',
        int $port = 1883,
        string $clientId = null,
        string $username = null,
        string $password = null
    )
    {
        // Instantiate the client
        $this->client = new phpMQTT($host, $port, $clientId);
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId)
    {
        $this->client->clientid = $clientId;
    }

    public function connect()
    {
        $this->client->connect(true);
    }

    /**
     * @param Closure $callback
     */
    public function listen(Closure $callback)
    {
        $this->connect();

        $this->client->subscribe(['#' => ['function' => $callback, 'qos' => 0]], 0);

        while ($this->client->proc()) {}

        $this->client->close();
    }

    /**
     * @param string $topic
     * @param string $message
     */
    public function publish(string $topic, $message): void
    {
        $this->setClientId('SmartHome' . microtime());
        $this->connect();

        $this->client->publish($topic, $message, 1, 1);

        $this->client->close();
    }
}