<?php

namespace SmartHome\Domain\Xiaomi\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use SmartHome\Domain\Xiaomi\Entities\XiaomiLog;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Events\MessageReceived;

class LogReceivedMessages
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
     * @param MessageReceived $event
     */
    public function handle(MessageReceived $event)
    {
        XiaomiLog::create([
            'cmd' => $event->message->type(),
            'ip' => $event->message->ip(),
            'model' => $event->message->model(),
            'message' => $event->message->toJson()
        ]);
    }
}
