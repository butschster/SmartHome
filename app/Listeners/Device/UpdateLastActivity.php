<?php

namespace App\Listeners\Device;

use App\Events\Device\Ping;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastActivity
{
    /**
     * @param Ping $event
     */
    public function handle(Ping $event)
    {
        $event->device->updateLastActivity();
    }
}
