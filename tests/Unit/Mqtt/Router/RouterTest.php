<?php

namespace Tests\Unit\Mqtt\Router;

use Illuminate\Contracts\Events\Dispatcher;
use SmartHome\Domain\Mqtt\Contracts\Request;
use SmartHome\Domain\Mqtt\Router\Route;
use SmartHome\Domain\Mqtt\Router;
use Tests\TestCase;
use Mockery as m;

class RouterTest extends TestCase
{
    /**
     * @var Router
     */
    private $router;

    public function setUp()
    {
        parent::setUp();

        $this->router = new Router(
            $this->app, $this->app[Dispatcher::class]
        );
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    function test_it_can_be_listen()
    {
        $this->assertCount(0, $this->router->getRoutes());

        $route = $this->router->listen('stat/device/information', 'TestController@action');

        $this->assertCount(1, $this->router->getRoutes());
        $this->assertInstanceOf(Route::class, $route);
    }

    function test_it_can_dispatch_found_route_with_controller()
    {
        $this->router->namespace('Tests\\Unit\\Mqtt\\Router');
        $this->router->listen('stat/{device}/information', 'TestController@action');
        $this->router->listen('stat/{device}/information1', 'TestController@anoterAction');
        $message = m::mock(Request::class);

        $message->shouldReceive('setRouteResolver')->once();
        $message->shouldReceive('route')->once();
        $message->shouldReceive('getRoute')->andReturn('stat/device/information');
        $response = $this->router->dispatch($message);

        $this->assertEquals('device', $response);
    }

    function test_it_can_dispatch_found_route_with_closure()
    {
        $this->router->namespace('Tests\\Unit\\Mqtt\\Router');

        $this->router->listen('stat/{device}/information', function (Request $message, string $device) {
            $this->assertEquals('stat/device/information', $message->getRoute());
            $this->assertEquals('device', $device);
            return 'test';
        });

        $message = m::mock(Request::class);
        $message->shouldReceive('getRoute')->andReturn('stat/device/information');
        $response = $this->router->dispatch($message);

        $this->assertEquals('test', $response);
    }

    /**
     * @expectedException SmartHome\Domain\Mqtt\Exceptions\RouteNotFoundException
     */
    function test_it_should_throw_an_exception_if_route_not_found()
    {
        $this->router->listen('stat/device/information', 'TestController@action');

        $message = m::mock(Request::class);

        $message->shouldReceive('getRoute')->andReturn('stat/device/information1');
        $this->router->dispatch($message);
    }

    function test_it_can_set_namespace()
    {
        $route = $this->router->listen('stat/device/information', 'TestController@action');

        $this->assertEquals('TestController@action', $route->action['controller']);

        $this->router->namespace('Test\\Namespace');
        $route = $this->router->listen('stat/device/information', 'TestController@action');
        $this->assertEquals('Test\\Namespace\\TestController@action', $route->action['controller']);
    }
}

class TestController
{
    public function action(Request $message, string $device)
    {
        return $device;
    }
}
