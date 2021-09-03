<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Transaction
 *
 * @property int $id
 * @property int $type_id ID типа
 * @property int $user_id ID пользователя
 * @property int $currency_id ID типа
 * @property float $balance_token_amount Изменение баланса на основном счету в токенах
 * @property float $balance_token_deposit_amount Изменение баланса на депозитном счету в токенах
 * @property int $balance_coin_amount Изменение баланса золотых монет
 * @property float $amount Сумма в валюте транзакции
 * @property float $amount_usd Сумма в USD
 * @property float $rate_xau Текущий курс XAU/USD
 * @property float $rate_token Текущий курс TOKEN/XAU
 * @property string $status Статус
 * @property string|null $comment Комментарий транзакции
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Currency $currency
 * @property-read \App\TransactionType $type
 * @property-read \App\User $user
 * @property-read \App\Wallet $wallet
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmountUsd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBalanceCoinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBalanceTokenAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereBalanceTokenDepositAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRateToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereRateXau($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 * @mixin \Eloquent
 */
class Transaction extends Model
{
    use CrudTrait;

    const STATUS_NEW = 'new';
    const STATUS_WAIT = 'wait';
    const STATUS_SUCCESS = 'success';
    const STATUS_ERROR = 'error';
    const STATUS_CANCEL = 'cancel';

    const ALL_STATUSES = [
        \App\Transaction::STATUS_NEW,
        \App\Transaction::STATUS_WAIT,
        \App\Transaction::STATUS_SUCCESS,
        \App\Transaction::STATUS_ERROR,
        \App\Transaction::STATUS_CANCEL,
    ];

    /** @inheritDoc */
    protected $fillable = [
        'user_id',
        'type_id',
        'currency_id',
        'balance_token_amount',
        'balance_token_deposit_amount',
        'amount',
        'amount_usd',
        'rate_token',
        'rate_xau',
        'status',
        'comment',
    ];

    /**
     * Применение транзакции
     *
     * @param string $status
     * @return bool
     */
    public function apply(string $status = self::STATUS_SUCCESS)
    {
        // если транзакция уже была обработана
        if (in_array($this->status, [self::STATUS_CANCEL, self::STATUS_SUCCESS, self::STATUS_ERROR])) {
            return false;
        }

        $isManual = in_array($this->type_id, TransactionType::TYPES_FOR_MANUAL_HANDLING);
        $isWithdraw = in_array($this->type_id, TransactionType::WITHDRAW_TYPES);
        $isDeposit = in_array($this->type_id, TransactionType::DEPOSIT_TYPES);
        $isBalanceTransfer = in_array($this->type_id, TransactionType::BALANCE_TRANSFER_TYPES);

        switch ($status) {
            case self::STATUS_CANCEL:
                if ($isManual && $isWithdraw) {
                    $this->user->balance_token -= $this->balance_token_amount;
                    $this->user->balance_token_deposit -= $this->balance_token_deposit_amount;
                    $this->user->balance_coin -= $this->balance_coin_amount;
                    $this->user->save();
                }
                break;
            case self::STATUS_WAIT:
                if ($isManual && $isWithdraw) {
                    $this->user->balance_token += $this->balance_token_amount;
                    $this->user->balance_token_deposit += $this->balance_token_deposit_amount;
                    $this->user->balance_coin += $this->balance_coin_amount;
                    $this->user->save();
                }
                break;
            case self::STATUS_SUCCESS:
                if ($isDeposit || $isBalanceTransfer) {
                    $this->user->balance_token += $this->balance_token_amount;
                    $this->user->balance_token_deposit += $this->balance_token_deposit_amount;
                    $this->user->balance_coin += $this->balance_coin_amount;
                    $this->user->save();
                }
                break;
        }

        $this->status = $status;

        return $this->save();
    }

    /**
     * Расчет суммы в эквиваленте долларов с учетом текущей валюты
     *
     * @return float
     */
    public function calculateUsdAmount(): float
    {
        switch ($this->currency_id) {
            case Currency::RTL:
                return 0;
            case Currency::USD:
                return $this->amount;
        }

        return Currency::getRate($this->currency_id, $this->amount);
    }

    /**
     * Расчет суммы токенов с учетом суммы транзакции и курсов
     *
     * @return float
     */
    public function calculateTokenAmount(): float
    {
        if ($this->currency_id === Currency::RTL) {
            return $this->amount;
        }

        $amount = $this->calculateUsdAmount() / $this->rate_xau / $this->rate_token;

        if (in_array($this->type_id, TransactionType::WITHDRAW_TYPES)) {
            return -$amount;
        }

        return $amount;
    }

    /**
     * Пользователь транзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Тип трнзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    /**
     * Кошельки транзакции
     *
     */
    public function wallets()
    {
        return $this->belongsToMany(Wallet::class, 'transaction_wallet');
    }

    /**
     * Кошелек транзакции
     *
     */
    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'id', 'id', 'transaction_wallet');
    }

    /**
     * Тип трнзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    /**
     * Создание контекста для транзакции
     *
     * @param string $data
     * @return TransactionContext|Model
     */
    public function createContext(string $data): TransactionContext
    {
        return TransactionContext::create([
            'transaction_id' => $this->id,
            'data' => $data,
        ]);
    }

    /**
     * Проверить, нужна ли ручная обработка заявки (одобрение/отказ)
     *
     * @return bool
     */
    public function needManualHandling(): bool
    {
        return $this->status === self::STATUS_WAIT
            && in_array($this->type_id, TransactionType::TYPES_FOR_MANUAL_HANDLING, true);
    }

    /**
     * Транзакция на пополнение?
     *
     * @return bool
     */
    public function isDepositTransaction(): bool
    {
        return in_array($this->type_id, TransactionType::DEPOSIT_TYPES, true);
    }

    /**
     * Транзакция на вывод?
     *
     * @return bool
     */
    public function isWithdrawTransaction(): bool
    {
        return in_array($this->type_id, TransactionType::WITHDRAW_TYPES, true);
    }

    /**
     * Транзакция ранговой монеты?
     *
     * @return bool
     */
    public function isRankCoinTransaction(): bool
    {
        return in_array($this->type_id, [
            TransactionType::DEPOSIT_RANK_COIN,
            TransactionType::WITHDRAW_RANK_COIN
        ], true);
    }

    /**
     * Получить действия для транзакции в круд форме админ панели
     *
     * @return string
     */
    public function getActionButtonsForAdminForm(): string
    {
        if (!$this->needManualHandling()) {
            return '-';
        }

        return '<div>'
            . '<a href="' . route('admin.transaction.confirm', $this->id) . '" class="btn btn-success btn-sm btn-block" style="color: #fff; cursor: pointer;">' . trans('admin.confirm') . '</a>'
            . '<a href="' . route('admin.transaction.cancel', $this->id) . '" class="btn btn-danger btn-sm btn-block" style="color: #fff; cursor: pointer;">' . trans('admin.cancel') . '</a>'
            . '</div>';
    }
}
