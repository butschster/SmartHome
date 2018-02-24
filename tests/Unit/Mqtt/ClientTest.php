<?php

namespace Tests\Unit\Mqtt;

use SmartHome\Domain\Mqtt\Client;
use Bluerhinos\phpMQTT;
use Tests\TestCase;
use Mockery as m;

class ClientTest extends TestCase
{
    function test_sets_client_id()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient()
        );

        $client->setClientId('test');
        $this->assertEquals('test', $mqttClient->clientid);
    }

    function test_default_options()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient()
        );

        $this->assertEquals([
            'username' => null,
            'password' => null
        ], $client->options());
    }

    function test_sets_allowed_options()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient(),
            [
                'username' => 'test',
                'password' => 'test_password'
            ]
        );

        $this->assertEquals([
            'username' => 'test',
            'password' => 'test_password'
        ], $client->options());
    }

    /**
     * @expectedException Symfony\Component\OptionsResolver\Exception\UndefinedOptionsException
     */
    function test_sets_not_allowed_options()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient(),
            [
                'username1' => 'test',
                'password' => 'test_password'
            ]
        );
    }

    function test_it_can_connect_to_mqtt_broker()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient(),
            [
                'username' => 'test',
                'password' => 'test_password'
            ]
        );

        $mqttClient->shouldReceive('connect')
            ->once()
            ->with(true, null, 'test', 'test_password');

        $client->connect();
    }

    function test_it_can_listen_mqtt_messages()
    {
        $client = new Client(
            $mqttClient = $this->makePhpMqttClient()
        );

        $callback = function () {};

        $mqttClient->shouldReceive('connect')
            ->once()
            ->with(true, null, null, null);

        $mqttClient->shouldReceive('subscribe')
            ->once()
            ->andReturnUsing(function ($listeners, $qos) use ($callback) {
                $this->assertEquals(0, $qos);
                $this->assertEquals($listeners['#']['function'], $callback);
                $this->assertEquals($listeners['#']['qos'], 0);
            });

        $mqttClient->shouldReceive('proc')->once()->andReturn(false);
        $mqttClient->shouldReceive('close')->once();

        $client->listen($callback);
    }

    function test_it_can_publish_mqtt_messages()
    {
        $client = m::mock(Client::class.'[setClientId]', [
            $mqttClient = $this->makePhpMqttClient()
        ]);

        $client->shouldReceive('setClientId')->once();

        $mqttClient->shouldReceive('connect')
            ->once()
            ->with(true, null, null, null);

        $topic = 'test_topic';
        $message = 'test message';

        $mqttClient->shouldReceive('publish')
            ->once()
            ->with($topic, $message, 1, 1);

        $mqttClient->shouldReceive('close')->once();

        $client->publish($topic, $message);
    }

    /**
     * @return m\MockInterface|phpMQTT
     */
    protected function makePhpMqttClient()
    {
        return m::mock(phpMQTT::class);
    }
}
