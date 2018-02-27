<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Events;

use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Command;

class SendCommand
{
    /**
     * @var Command
     */
    public $command;

    /**
     * @var resource
     */
    public $connection;

    /**
     * @param $connection
     * @param Command $command
     */
    public function __construct($connection, Command $command)
    {
        $this->command = $command;
        $this->connection = $connection;
    }
}