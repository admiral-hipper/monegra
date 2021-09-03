<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;
use App\User;

class ConfirmRegistration extends Notification
{
    /**
     * Получить каналы уведомления
     *
     * @param mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Получить представление уведомления для почтового сообщения
     *
     * @param User $notifiable
     * @return MailMessage
     */
    public function toMail(User $notifiable)
    {
        $verificationCode = $notifiable->generateVerificationCode('registration');

        return (new MailMessage)
            ->greeting(trans('Hello') . ", {$notifiable->name}")
            ->salutation(trans('Regards') . ', ' . config('app.name'))
            ->subject(trans('Confirmation of registration'))
            ->line(trans('Your unique code to confirm registration:'))
            ->line(new HtmlString("<strong>{$verificationCode}</strong>"))
            ->line(new HtmlString('<small style="opacity: 0.7;">' . trans('If you did not create an account, no further action is required') . '</small>'));
    }
}
