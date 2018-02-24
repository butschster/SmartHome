<?php

namespace SmartHome\Domain\Devices\Events\DeviceProperty;

use SmartHome\Domain\Devices\Entities\DeviceProperty;
use SmartHome\Http\Devices\Resources\DevicePropertyResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class Changed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var DeviceProperty
     */
    public $property;

    /**
     * @param DeviceProperty $property
     */
    public function __construct(DeviceProperty $property)
    {
        $this->property = $property;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('device.property.'.$this->property->id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'property.changed';
    }
    
    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'property' => new DevicePropertyResource($this->property)
        ];
    }
    
}
