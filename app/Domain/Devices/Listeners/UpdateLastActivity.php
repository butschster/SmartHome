<?php

namespace SmartHome\Domain\Devices\Listeners;

use SmartHome\Domain\Devices\Events\Device\Ping;

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
