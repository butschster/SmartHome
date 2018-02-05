<?php

namespace App\Listeners;

use App\Notifications\Channels\VoiceChannel;
use App\Notifications\Device\RegisteredNotification;
use Illuminate\Support\Facades\Notification;

class NotifyAboutNewDevice
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        notify(new RegisteredNotification($event->device));
    }
}
