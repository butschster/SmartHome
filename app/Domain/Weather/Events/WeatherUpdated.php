<?php

namespace SmartHome\Domain\Weather\Events;

use SmartHome\Domain\Weather\Weather;
use SmartHome\Http\Weather\Resources\WearherResource;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class WeatherUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Weather
     */
    public $weather;

    /**
     * WeatherUpdated constructor.
     * @param Weather $weather
     */
    public function __construct(Weather $weather)
    {
        $this->weather = $weather;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('weather');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'updated';
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'weather' => new WearherResource($this->weather)
        ];
    }
}
