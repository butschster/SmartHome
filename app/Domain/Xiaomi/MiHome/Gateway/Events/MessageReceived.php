<?php

namespace SmartHome\Domain\Xiaomi\MiHome\Gateway\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use SmartHome\Domain\Xiaomi\Contracts\Mihome\Gateway\Hub;
use SmartHome\Domain\Xiaomi\MiHome\Gateway\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class MessageReceived implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Message
     */
    public $message;

    /**
     * @var string
     */
    public $remoteIp;

    /**
     * @param Message $message
     * @param string $remoteIp
     */
    public function __construct(Message $message, string $remoteIp)
    {
        $this->message = $message;
        $this->remoteIp = $remoteIp;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('xiaomi');
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'message';
    }

    public function broadcastWith()
    {
        return [];
    }
}
