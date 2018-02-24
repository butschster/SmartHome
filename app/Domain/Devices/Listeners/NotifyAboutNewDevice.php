<?php

namespace SmartHome\Domain\Devices\Listeners;

use SmartHome\Domain\Devices\Notifications\DeviceRegisteredNotification;

class NotifyAboutNewDevice
{
    /**
     * Handle the event.
     *
     * @param  object $event
     * @return void
     */
    public function handle($event)
    {
        notify(new DeviceRegisteredNotification($event->device));
    }
}
