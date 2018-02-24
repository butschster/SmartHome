<?php

namespace Tests\Unit\Mqtt;

use SmartHome\Domain\Mqtt\Router\Response;
use Tests\TestCase;

class ClientResponseTest extends TestCase
{
    function test_gets_route()
    {
        $response = new Response('topic/device', 'string');

        $this->assertEquals('topic/device', $response->getRoute());
    }
    function test_gets_payload()
    {
        $response = new Response('topic/device', 'string');

        $this->assertEquals('string', $response->getPayload());
    }

    function test_gets_array_from_string()
    {
        $response = new Response('topic/device', 'string');

        $this->assertEquals(['string'], $response->toArray());
    }

    function test_gets_array_from_json()
    {
        $response = new Response('topic/device', '{"hello" : "world"}');

        $this->assertEquals(['hello' => 'world'], $response->toArray());
    }
}
