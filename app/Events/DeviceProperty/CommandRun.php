<?php

namespace App\Events\DeviceProperty;

use App\Entities\DeviceProperty;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CommandRun
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var DeviceProperty
     */
    public $property;
    /**
     * @var string
     */
    public $command;

    /**
     * @param DeviceProperty $property
     * @param string $command
     */
    public function __construct(DeviceProperty $property, string $command)
    {
        $this->property = $property;
        $this->command = $command;
    }
}
