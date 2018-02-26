<?php

namespace SmartHome\Domain\Mqtt\Listeners;

use SmartHome\Domain\Mqtt\MqttLog;
use SmartHome\Domain\Mqtt\Events\MessageReceived;

class LogMessages
{

    /**
     * @param MessageReceived $message
     */
    public function handle(MessageReceived $message)
    {
        MqttLog::create([
            'topic' => $message->topic,
            'message' => $message->message
        ]);
    }
}
