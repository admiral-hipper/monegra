<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionType
 *
 * @property int $id
 * @property string $name_ru Название (русский)
 * @property string $name_en Название (английский)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionType whereNameRu($value)
 * @mixin \Eloquent
 */
class TransactionType extends Model
{
    const DEPOSIT_PAYEER        = 1;  // покупка TOKEN с Payeer кошелька
    const DEPOSIT_PM            = 2;  // покупка TOKEN с Perfect Money кошелька
    const DEPOSIT_BTC           = 3;  // покупка TOKEN с BTC кошелька
    const DEPOSIT_ETH           = 4;  // покупка TOKEN с ETH кошелька
    const DEPOSIT_PZM           = 5;  // покупка TOKEN с PZM кошелька
    const DEPOSIT_DAILY_ACCRUAL = 6;  // начисление дивидендов на депозитный баланс
    const WITHDRAW_PAYEER       = 7;  // продажа TOKEN на Payeer кошелек
    const WITHDRAW_PM           = 8;  // продажа TOKEN на Perfect Money кошелек
    const WITHDRAW_BTC          = 9;  // продажа TOKEN на ETH кошелек
    const WITHDRAW_ETH          = 10; // продажа TOKEN на ETH кошелек
    const WITHDRAW_PZM          = 11; // продажа TOKEN на PZM кошелек
    const DEPOSIT_REF_BONUS     = 12; // начисление бонуса TOKEN от начисления привлеченных рефералов
    const MOVE_TO_DEPOSIT       = 13; // перевод TOKEN с расчетного счета на депозитный
    const MOVE_FROM_DEPOSIT     = 14; // перевод TOKEN с депозитного счета на расчетный
    const DEPOSIT_RANK_TOKEN    = 15; // начисление бонуса TOKEN с ранговой программы
    const DEPOSIT_RANK_COIN     = 16; // начисление золотой монеты
    const WITHDRAW_RANK_COIN    = 17; // отправка золотой монеты
    const DEPOSIT_ADMIN         = 18; // начисление TOKEN от админа

    /** @var int[] Типы транзакций для ручного подтверждения заявок админом */
    const TYPES_FOR_MANUAL_HANDLING = [
        self::WITHDRAW_PAYEER,
        self::WITHDRAW_PM,
        self::WITHDRAW_BTC,
        self::WITHDRAW_ETH,
        self::WITHDRAW_PZM,
        self::DEPOSIT_BTC,
        self::DEPOSIT_ETH,
        self::DEPOSIT_PZM,
        self::WITHDRAW_RANK_COIN,
    ];

    /** @var int[] Типы транзакций для покупки токена */
    const DEPOSIT_TYPES = [
        self::DEPOSIT_PAYEER,
        self::DEPOSIT_PM,
        self::DEPOSIT_BTC,
        self::DEPOSIT_ETH,
        self::DEPOSIT_PZM,
        self::DEPOSIT_DAILY_ACCRUAL,
        self::DEPOSIT_REF_BONUS,
        self::DEPOSIT_RANK_TOKEN,
        self::DEPOSIT_RANK_COIN,
        self::DEPOSIT_ADMIN,
    ];

    /** @var int[] Типы транзакций для продажи токена */
    const WITHDRAW_TYPES = [
        self::WITHDRAW_PAYEER,
        self::WITHDRAW_PM,
        self::WITHDRAW_BTC,
        self::WITHDRAW_ETH,
        self::WITHDRAW_PZM,
        self::WITHDRAW_RANK_COIN,
    ];

    /** @var int[] Типы транзакций для переводов между балансами */
    const BALANCE_TRANSFER_TYPES = [
        self::MOVE_TO_DEPOSIT,
        self::MOVE_FROM_DEPOSIT,
    ];

    /** @inheritDoc */
    protected $fillable = [
        'name_ru',
        'name_en',
    ];

    /**
     * Получить ID типа по кошельку
     *
     * @param Wallet $wallet
     * @param string $action
     * @return int
     */
    public static function getTypeIdByWallet(Wallet $wallet, string $action = 'deposit'): int
    {
        $isDeposit = $action === 'deposit';

        if ($wallet->type->currency->id !== Currency::USD) {
            $type = constant('\App\TransactionType::' . ($isDeposit ? 'DEPOSIT_' : 'WITHDRAW_') . $wallet->type->currency->code);
        } else {
            switch ($wallet->type->name) {
                case 'Payeer':
                    $type = $isDeposit ? TransactionType::DEPOSIT_PAYEER : TransactionType::WITHDRAW_PAYEER;
                    break;
                case 'Perfect Money':
                    $type = $isDeposit ? TransactionType::DEPOSIT_PM : TransactionType::WITHDRAW_PM;
                    break;
                default:
                    throw new \InvalidArgumentException('Invalid wallet type name.');
            }
        }

        return $type;
    }
}
