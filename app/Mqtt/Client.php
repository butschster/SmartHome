<?php

namespace App\Mqtt;

use App\Contracts\Mqtt\Client as ClientContract;
use App\Helpers\HasOptions;
use Bluerhinos\phpMQTT;
use Closure;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Client implements ClientContract
{
    use HasOptions;

    /**
     * @var phpMQTT
     */
    protected $client;

    /**
     * @param phpMQTT $client
     * @param array $options
     */
    public function __construct(phpMQTT $client, array $options = [])
    {
        $this->client = $client;

        $this->setOptions($options);
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
        $this->client->connect(
            true,
            null,
            $this->options['username'],
            $this->options['password']
        );
    }

    /**
     * @param Closure $callback
     */
    public function listen(Closure $callback)
    {
        $this->connect();

        $this->client->subscribe(['#' => ['function' => $callback, 'qos' => 0]], 0);

        $this->loop();

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

    protected function loop(): void
    {
        while ($this->client->proc()) {
            //
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'username' => null,
            'password' => null
        ]);
    }
}