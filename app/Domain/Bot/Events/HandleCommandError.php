<?php

namespace SmartHome\Domain\Bot\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class HandleCommandError
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string
     */
    public $command;

    /**
     * SpechCommandNotFound constructor.
     * @param string $command
     */
    public function __construct(string $command)
    {
        $this->command = $command;
    }
}
