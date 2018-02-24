<?php

namespace SmartHome\Domain\Mqtt\Listeners;

use SmartHome\Domain\Mqtt\MqttLog;
use SmartHome\Domain\Mqtt\Events\Message;

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
