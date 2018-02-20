<?php

namespace App\Events\Device;

use App\Entities\Device;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class Ping
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Device
     */
    public $device;

    /**
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }
}
