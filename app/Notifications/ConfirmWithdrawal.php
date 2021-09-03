<?php

namespace App\Notifications;

use App\User;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ConfirmWithdrawal extends Notification
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
        $verificationCode = $notifiable->generateVerificationCode('withdrawal');

        return (new MailMessage)
            ->greeting(trans('Hello') . ", {$notifiable->name}")
            ->salutation(trans('Regards') . ', ' . config('app.name'))
            ->subject(trans('Confirmation of withdrawal'))
            ->line(trans('Your unique code to confirm withdrawal:'))
            ->line(new HtmlString("<strong>{$verificationCode}</strong>"))
            ->line(new HtmlString('<small style="opacity: 0.7;">' . trans('If you did not create a withdrawal request, this is a reason to review access to your account') . '</small>'));
    }
}
