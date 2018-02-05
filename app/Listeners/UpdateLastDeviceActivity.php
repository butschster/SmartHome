<?php

namespace App\Listeners;

use App\Events\DevicePing;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateLastDeviceActivity
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param DevicePing $event
     */
    public function handle(DevicePing $event)
    {
        $event->device->updateLastActivity();
    }
}
