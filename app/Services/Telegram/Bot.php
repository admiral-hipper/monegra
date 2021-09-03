<?php

namespace App\Services\Telegram;

use App\Transaction;
use App\TransactionType;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class Bot
 * @package App\Services\Telegram
 */
class Bot extends Telegram
{
    /**
     * @param Transaction $transaction
     * @return void
     */
    public static function sendTransactionNotifyToAdmin(Transaction $transaction): void
    {
        $text = "<b>Ritofos</b>\n\n";

        if ($transaction->isDepositTransaction()) {
            $text .= "<b>Покупка (с {$transaction->currency->code}</b>) #$transaction->id 🤑\n";
        } elseif ($transaction->isWithdrawTransaction()) {
            $text .= "<b>Продажа (на {$transaction->currency->code})</b>) #$transaction->id 🔻\n";
        } else {
            return;
        }

        $url = [
            'user' => url('/admin/user?id=' . $transaction->user_id),
            'transaction' => url('/admin/transaction?id=' . $transaction->id),
        ];

        $text .= <<<HTML
<b>Дата:</b> {$transaction->created_at}
<b>Email:</b> {$transaction->user->email} (<a href="{$url['user']}">просмотр</a>)
<b>Баланс:</b> {$transaction->user->balance_token}RTL / {$transaction->user->balance_token_deposit}RTL
<b>Сумма:</b> {$transaction->balance_token_amount}RTL
<b>Система:</b> {$transaction->wallets[0]->type->name}
<b>Валюта:</b> {$transaction->amount}{$transaction->currency->code}
<b>Кошелек:</b> {$transaction->wallets[0]->number}
HTML;

        if (in_array($transaction->type_id, TransactionType::TYPES_FOR_MANUAL_HANDLING)) {
            $text .= <<<HTML
\n\n<b>Ручное подтверждение</b>
<a href="{$url['transaction']}">Одобрить / Отменить</a>
HTML;
        }

        try {
            self::bot()->sendMessage([
                'chat_id' => env('TELEGRAM_ADMIN_ID', 735032395),
                'text' => $text,
                'parse_mode' => 'html',
            ]);
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }
}
