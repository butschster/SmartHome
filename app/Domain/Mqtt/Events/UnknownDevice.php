<?php

namespace SmartHome\Domain\Mqtt\Events;

class UnknownDevice
{
    /**
     * @var string
     */
    public $device;

    /**
     * @var string
     */
    public $type;

    /**
     * @param string $device
     * @param string $type
     */
    public function __construct(string $device, string $type)
    {
        $this->device = $device;
        $this->type = $type;
    }
}