<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Events;

use SmartHome\Domain\Xiaomi\MiHome\Gateway\Message;

class MessageReceived
{
    /**
     * @var Message
     */
    public $message;

    /**
     * @var resource
     */
    public $connection;

    /**
     * @param $connection
     * @param Message $message
     */
    public function __construct($connection, Message $message)
    {
        $this->message = $message;
        $this->connection = $connection;
    }
}
