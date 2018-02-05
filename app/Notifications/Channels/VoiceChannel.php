<?php

namespace App\Notifications\Channels;

use App\Events\Say;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Notifications\Notification;

class VoiceChannel
{
    /**
     * @var Dispatcher
     */
    private $events;

    /**
     * @param Dispatcher $events
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed $notifiable
     * @param  \Illuminate\Notifications\Notification $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        say($notification->toVoice($notifiable));
    }
}