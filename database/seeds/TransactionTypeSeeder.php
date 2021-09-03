<?php

use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\TransactionType::insertOrIgnore([
            [
                'id' => \App\TransactionType::DEPOSIT_PAYEER,
                'name_ru' => 'Пополнение Payeer',
                'name_en' => 'Replenishment Payeer',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_PM,
                'name_ru' => 'Пополнение PerfectMoney',
                'name_en' => 'Replenishment PerfectMoney',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_BTC,
                'name_ru' => 'Пополнение Bitcoin',
                'name_en' => 'Replenishment Bitcoin',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_ETH,
                'name_ru' => 'Пополнение Ethereum',
                'name_en' => 'Replenishment Ethereum',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_PZM,
                'name_ru' => 'Пополнение Prizm',
                'name_en' => 'Replenishment Prizm',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_DAILY_ACCRUAL,
                'name_ru' => 'Начисление на остаток депозитного счета',
                'name_en' => 'Accrual to the balance of the deposit account',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_PAYEER,
                'name_ru' => 'Вывод через Payeer',
                'name_en' => 'Withdrawal via Payeer',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_PM,
                'name_ru' => 'Вывод через PerfectMoney',
                'name_en' => 'Withdrawal via PerfectMoney',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_BTC,
                'name_ru' => 'Вывод через Bitcoin',
                'name_en' => 'Withdrawal via Bitcoin',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_ETH,
                'name_ru' => 'Вывод через Ethereum',
                'name_en' => 'Withdrawal via Ethereum',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_PZM,
                'name_ru' => 'Вывод через Prizm',
                'name_en' => 'Withdrawal via Prizm',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_REF_BONUS,
                'name_ru' => 'Начисление бонуса RTL от начисления привлеченных рефералов',
                'name_en' => 'Accrual of RTL bonus from accrual of attracted referrals',
            ],
            [
                'id' => \App\TransactionType::MOVE_TO_DEPOSIT,
                'name_ru' => 'Перевод с расчетного счета на депозитный',
                'name_en' => 'Transfer from the general balance to deposit',
            ],
            [
                'id' => \App\TransactionType::MOVE_FROM_DEPOSIT,
                'name_ru' => 'Перевод с депозитного счета на расчетный',
                'name_en' => 'Transfer from the deposit balance to general',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_RANK_TOKEN,
                'name_ru' => 'Бонус ранговой программы',
                'name_en' => 'Rank program bonus',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_RANK_COIN,
                'name_ru' => 'Начисление золотой монет RGP',
                'name_en' => 'Accrual RGP gold coin',
            ],
            [
                'id' => \App\TransactionType::WITHDRAW_RANK_COIN,
                'name_ru' => 'Отправка золотой монеты RGP',
                'name_en' => 'Sending RGP gold coin',
            ],
            [
                'id' => \App\TransactionType::DEPOSIT_ADMIN,
                'name_ru' => 'Системное пополнение баланса',
                'name_en' => 'System balance deposit',
            ],
        ]);
    }
}
