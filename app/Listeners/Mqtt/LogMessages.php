<?php

namespace App\Listeners\Mqtt;

use App\Entities\MqttLog;
use App\Events\Mqtt\Message;

class LogMessages
{

    /**
     * @param Message $message
     */
    public function handle(Message $message)
    {
        MqttLog::create([
            'topic' => $message->topic,
            'message' => $message->message
        ]);
    }
}
