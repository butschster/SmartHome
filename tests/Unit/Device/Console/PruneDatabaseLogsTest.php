<?php

namespace Tests\Unit\Device\Console;

use Illuminate\Support\Facades\Event;
use SmartHome\Domain\Devices\Console\Commands\PruneDatabaseLogs;
use SmartHome\Domain\Devices\Entities\DeviceLog;
use SmartHome\Domain\Devices\Events\Device\LogsPruned;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\NullOutput;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PruneDatabaseLogsTest extends TestCase
{
    use RefreshDatabase;

    function test_handle_command()
    {
        Event::fake([
            LogsPruned::class
        ]);

        $this->createDeviceLog([
            'created_at' => now()->subDays(2)
        ], 2);

        $this->createDeviceLog([
            'created_at' => now()->subDays(8)
        ], 4);

        $this->assertEquals(6, DeviceLog::count());

        $command = new PruneDatabaseLogs();
        $command->setLaravel($this->app);

        $command->run(
            new StringInput(''),
            new NullOutput()
        );

        Event::assertDispatched(LogsPruned::class);

        $this->assertEquals(2, DeviceLog::count());
    }
}
