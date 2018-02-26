<?php

namespace SmartHome\Domain\Devices\Notifications;

use SmartHome\Domain\Bot\Notifications\VoiceChannel;
use SmartHome\Domain\Devices\Entities\Device;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class DeviceRegisteredNotification extends Notification
{
    use Queueable;

    /**
     * @var Device
     */
    private $device;

    /**
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [VoiceChannel::class];
    }

    public function toDatabase($notifiable)
    {
        return [

        ];
    }

    /**
     * @param $notifiable
     *
     * @return string
     */
    public function toVoice($notifiable): string
    {
        return "Зарегистрировано новое устройство";
    }
}
