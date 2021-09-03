<?php

namespace App\Console\Commands;

use App\{User, Setting};
use Illuminate\Console\Command;

class DailyAccrual extends Command
{
    /** @var @inheritDoc */
    protected $signature = 'cron:daily-accrual';

    /** @var @inheritDoc */
    protected $description = 'Ежедневные начисления на депозитный баланс (на остаток).';

    public function handle()
    {
        /** @var User[] $users */
        $users = User::whereIsAdmin(0)
            ->where('balance_token_deposit', '>', 0)
            ->get();

        // случайный процент
        [$from, $to] = Setting::getAccrualPercentRange();

        $percent = mt_rand($from * 100, $to * 100) / 10000;

        Setting::setLastUsedAccrualPercent($percent * 100);

        foreach ($users as $user) {
            $user->makeDailyAccrual($percent);
        }
    }
}
