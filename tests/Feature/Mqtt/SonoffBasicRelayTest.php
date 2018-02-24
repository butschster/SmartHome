<?php

namespace Tests\Feature\Mqtt;

use SmartHome\Domain\Devices\Entities\{
    Device, DeviceProperty, DevicePropertyLog
};
use SmartHome\Domain\Mqtt\Router\Response;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use SmartHome\Domain\Mqtt\Contracts\Router as RouterContract;

class SonoffBasicRelayTest extends TestCase
{
    use RefreshDatabase;

    function test_recieve_device_state()
    {
        /** @var RouterContract $router */
        $router = $this->app->make(RouterContract::class);

        $router->dispatch(new Response(
            'tele/sonoff_basic/test_device/STATE',
            '{"Time":"2018-02-01T14:11:58","Uptime":3,"Vcc":3.164,"POWER":"ON","POWER1":"OFF","Wifi":{"AP":1,"SSId":"ButscHNetwork","RSSI":46,"APMac":"04:BF:6D:0D:6B:06"}}'
        ));

        $device = Device::where('key', 'test_device')->first();
        $this->assertInstanceOf(Device::class, $device);
    }

    function test_recieve_device_power_result()
    {
        /** @var RouterContract $router */
        $router = $this->app->make(RouterContract::class);

        $router->dispatch(new Response(
            'stat/sonoff_basic/test_device/RESULT',
            '{"POWER":"ON"}'
        ));

        $device = Device::where('key', 'test_device')->first();
        $this->assertInstanceOf(Device::class, $device);

        $this->assertDatabaseHas((new DeviceProperty())->getTable(), [
            'device_id' => $device->id,
            'key' => 'POWER',
            'value' => 1
        ]);

        $router->dispatch(new Response(
            'stat/sonoff_basic/test_device/RESULT',
            '{"POWER":"OFF"}'
        ));

        $this->assertDatabaseHas((new DeviceProperty)->getTable(), [
            'device_id' => $device->id,
            'key' => 'POWER',
            'value' => 0
        ]);
    }

    function test_recieve_device_lwt()
    {
        /** @var RouterContract $router */
        $router = $this->app->make(RouterContract::class);

        $router->dispatch(new Response(
            'tele/sonoff_basic/DVES_807DC9/LWT',
            'Online'
        ));

        $device = Device::where('key', 'DVES_807DC9')->first();
        $this->assertInstanceOf(Device::class, $device);
    }
}
