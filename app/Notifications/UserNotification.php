<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class UserNotification extends Notification
{
    use Queueable;

    private $notification;

    public function __construct(string $notificationMessage)
    {
        $this->notification = ['message' => $notificationMessage];
    }

    /**
     * Получить каналы уведомления
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Получить представление уведомления для базы данных
     *
     * @return string[]
     */
    public function toDatabase()
    {
        return $this->notification;
    }
}
