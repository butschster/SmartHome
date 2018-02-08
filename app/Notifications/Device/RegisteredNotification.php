<?php

namespace App\Notifications\Device;

use App\Entities\Device;
use App\Notifications\Channels\VoiceChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class RegisteredNotification extends Notification
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
        return [VoiceChannel::class, 'database'];
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
