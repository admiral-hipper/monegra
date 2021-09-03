<?php

namespace App;

use App\Http\Traits\UserCodeVerification;
use App\Notifications\ConfirmRegistration;
use App\Notifications\UserNotification;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\{DatabaseNotification, Notifiable};
use Illuminate\Support\{Collection, Str};
use Illuminate\Support\Facades\Notification;
use Kalnoy\Nestedset\NodeTrait;

/**
 * App\User
 *
 * @property int $id ID пользователя
 * @property int|null $ref_parent_id ID пользователя который пригласил
 * @property string $ref_code Уникальный реферальный код
 * @property string $name Имя
 * @property string $surname Фамилия
 * @property string $email Email
 * @property string|null $email_verified_at Дата подтверждения почты
 * @property string|null $phone Телефон
 * @property string $password Пароль
 * @property float $balance_token Баланс в TOKEN
 * @property float $balance_token_deposit Баланс в TOKEN, который получает накопления (депозит)
 * @property int $balance_coin Баланс золотых монет
 * @property int $rank Ранг пользователя
 * @property string $locale Язык пользователя
 * @property int $is_admin Флаг админа
 * @property int $lft
 * @property int $rgt
 * @property string|null $remember_token
 * @property mixed|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Kalnoy\Nestedset\Collection|User[] $children
 * @property-read int|null $children_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\CoinOrder[] $coinOrders
 * @property-read int|null $coin_orders_count
 * @property-read string $referral_link
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read User|null $parent
 * @property-write mixed $parent_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Wallet[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Kalnoy\Nestedset\Collection|static[] all($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|User d()
 * @method static \Kalnoy\Nestedset\Collection|static[] get($columns = ['*'])
 * @method static \Kalnoy\Nestedset\QueryBuilder|User newModelQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|User newQuery()
 * @method static \Kalnoy\Nestedset\QueryBuilder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalanceCoin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalanceToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalanceTokenDeposit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocale($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRefCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRefParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRgt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read User|null $referralParent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,
        CrudTrait,
        NodeTrait,
        UserCodeVerification;

    // условия начисления бонусов по ранговой программе
    const RANK_CONDITIONS = [
        1 => ['rank' => 1, 'coin' => 0, 'token' => 50, 'my_deposit' => 500, 'referrals_deposit' => 2000],
        2 => ['rank' => 2, 'coin' => 1, 'token' => 100, 'my_deposit' => 1000, 'referrals_deposit' => 5000],
        3 => ['rank' => 3, 'coin' => 1, 'token' => 200, 'my_deposit' => 1500, 'referrals_deposit' => 10000],
        4 => ['rank' => 4, 'coin' => 2, 'token' => 200, 'my_deposit' => 2500, 'referrals_deposit' => 15000],
        5 => ['rank' => 5, 'coin' => 3, 'token' => 300, 'my_deposit' => 4000, 'referrals_deposit' => 25000],
        6 => ['rank' => 6, 'coin' => 4, 'token' => 400, 'my_deposit' => 6500, 'referrals_deposit' => 40000],
        7 => ['rank' => 7, 'coin' => 4, 'token' => 700, 'my_deposit' => 10000, 'referrals_deposit' => 60000],
        8 => ['rank' => 8, 'coin' => 3, 'token' => 1000, 'my_deposit' => 10000, 'referrals_deposit' => 85000],
        9 => ['rank' => 9, 'coin' => 2, 'token' => 2000, 'my_deposit' => 12500, 'referrals_deposit' => 120000],
        10 => ['rank' => 10, 'coin' => 1, 'token' => 3000, 'my_deposit' => 15000, 'referrals_deposit' => 160000],
    ];

    /** @inheritDoc */
    protected $fillable = [
        'ref_parent_id',
        'ref_code',
        'name',
        'surname',
        'email',
        'phone',
        'password',
        'is_admin',
        'locale',
        'balance_token',
        'balance_token_deposit',
        'balance_coin',
        'rank',
    ];

    /** @inheritDoc */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** @inheritDoc */
    protected $appends = ['referral_link'];

    /** @inheritDoc */
    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    /** @inheritDoc */
    protected static function boot()
    {
        parent::boot();

        self::creating(function (self $user) {
            $user->ref_code = $user->generateRefCode();
        });

        self::updating(function (self $user) {
            $user->makeRankAccrual();
        });
    }

    /** @inheritDoc */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new ConfirmRegistration);
    }

    /**
     * Получить полное имя пользователя
     *
     * @return string
     */
    public function getFullName(): string
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * Получение количества привлеченных рефералов (1го уровня)
     *
     * @param bool $withDescendants
     * @return int
     */
    public function referralsCount(bool $withDescendants = false): int
    {
        if ($withDescendants) {
            return $this->descendants()
                ->withDepth()
                ->having('depth', '<=', 8)
                ->get()
                ->count();
        }

        return self::where([$this->getParentIdName() => $this->id])->count();
    }

    /**
     * Реферальный родитель
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referralParent()
    {
        return $this->belongsTo(self::class, $this->getParentIdName(), 'id');
    }

    /**
     * Кошельки
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    /**
     * Транзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Заявки на монеты
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function coinOrders()
    {
        return $this->hasMany(CoinOrder::class);
    }

    /**
     * Уведомления
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function notifications()
    {
        return $this->morphMany(DatabaseNotification::class, 'notifiable')
            ->orderByRaw('CASE WHEN read_at THEN 1 ELSE 0 END ASC')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Получить реферальную ссылку пользователя
     *
     * @return string
     */
    public function getReferralLinkAttribute(): string
    {
        return $this->referral_link = route('register', ['ref' => $this->ref_code]);
    }

    /**
     * Проверить, является ли пользователь админом
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return (bool)$this->is_admin;
    }

    /** @inheritDoc */
    public function getLftName(): string
    {
        return 'lft';
    }

    /** @inheritDoc */
    public function getRgtName(): string
    {
        return 'rgt';
    }

    /** @inheritdoc */
    public function getParentIdName(): string
    {
        return 'ref_parent_id';
    }

    /**
     * Измение баланса пользователя (создается транзакция, которую нужно применить)
     *
     * @param int $transactionTypeId Тип транзакции
     * @param float $amount Сумма в зависимости от типа транзакции
     * @return Transaction|null
     * @throws \Exception
     */
    public function updateBalance(int $transactionTypeId, float $amount): ?Transaction
    {
        $transaction = new Transaction([
            'type_id' => $transactionTypeId,
            'user_id' => $this->id,
            'amount' => $amount,
        ]);

        switch ($transactionTypeId) {
            case TransactionType::DEPOSIT_PAYEER:
            case TransactionType::DEPOSIT_PM:
            case TransactionType::WITHDRAW_PAYEER:
            case TransactionType::WITHDRAW_PM:
                $transaction->currency_id = Currency::USD;
                break;
            case TransactionType::DEPOSIT_BTC:
            case TransactionType::WITHDRAW_BTC:
                $transaction->currency_id = Currency::BTC;
                break;
            case TransactionType::DEPOSIT_ETH:
            case TransactionType::WITHDRAW_ETH:
                $transaction->currency_id = Currency::ETH;
                break;
            case TransactionType::DEPOSIT_PZM:
            case TransactionType::WITHDRAW_PZM:
                $transaction->currency_id = Currency::PZM;
                break;
            case TransactionType::DEPOSIT_DAILY_ACCRUAL:
                $transaction->currency_id = Currency::RTL;
                $transaction->balance_token_deposit_amount = $amount;
                break;
            case TransactionType::DEPOSIT_REF_BONUS:
            case TransactionType::DEPOSIT_RANK_TOKEN:
            case TransactionType::DEPOSIT_ADMIN:
                $transaction->currency_id = Currency::RTL;
                $transaction->balance_token_amount = $amount;
                break;
            case TransactionType::MOVE_TO_DEPOSIT:
                $transaction->currency_id = Currency::RTL;
                $transaction->balance_token_amount = -$amount;
                $transaction->balance_token_deposit_amount = $amount;
                break;
            case TransactionType::MOVE_FROM_DEPOSIT:
                $transaction->currency_id = Currency::RTL;
                $transaction->balance_token_amount = $amount;
                $transaction->balance_token_deposit_amount = -$amount;
                break;
            case TransactionType::DEPOSIT_RANK_COIN:
                $transaction->currency_id = Currency::RGP;
                $transaction->balance_coin_amount = $amount;
                break;
            case TransactionType::WITHDRAW_RANK_COIN:
                $transaction->currency_id = Currency::RGP;
                $transaction->balance_coin_amount = -$amount;
                break;
            default:
                throw new \Exception('Invalid transaction type.');
        }

        // для операций локальных валют изменяются только поля балансов
        $excludeTypes = [
            TransactionType::DEPOSIT_DAILY_ACCRUAL,
            TransactionType::DEPOSIT_REF_BONUS,
            TransactionType::DEPOSIT_RANK_TOKEN,
            TransactionType::DEPOSIT_RANK_COIN,
            TransactionType::MOVE_TO_DEPOSIT,
            TransactionType::MOVE_FROM_DEPOSIT,
            TransactionType::DEPOSIT_RANK_COIN,
            TransactionType::WITHDRAW_RANK_COIN,
            TransactionType::DEPOSIT_ADMIN,
        ];

        if (!in_array($transactionTypeId, $excludeTypes)) {
            $rateTokenBuy = Currency::getRate();
            $rateTokenSell = Currency::modifyForSell($rateTokenBuy);
            $transaction->rate_xau = Currency::getRate(Currency::XAU);
            if (in_array($transactionTypeId, TransactionType::WITHDRAW_TYPES)) {
                $transaction->rate_token = $rateTokenSell;
            } else {
                $transaction->rate_token = $rateTokenBuy;
            }
            // фиксируется курс покупки, чтобы можно было высчитать разницу
            // с курсом продажи в транзакциях на продажу TOKEN, потому что
            // в них в поле rate_token записывается курс продажи TOKEN
            $transaction->comment = $rateTokenSell . '/' . $rateTokenBuy;
            $transaction->amount_usd = $transaction->calculateUsdAmount();
            $transaction->balance_token_amount = $transaction->calculateTokenAmount();
        }

        return $transaction->save() ? $transaction : null;
    }

    /**
     * Ежедневные начисления на депозитный баланс
     *
     * @param float $percent
     * @throws \Throwable
     */
    public function makeDailyAccrual(float $percent = 0.0001): void
    {
        // средства пополненные на депозитный баланс сегодня или вчера не учитываются
        $excludedDepositSum = (float)$this->transactions()
            ->where(['type_id' => TransactionType::MOVE_TO_DEPOSIT])
            ->whereRaw('(DATE(created_at) = CURDATE() OR DATE(created_at) = CURDATE() - INTERVAL 1 DAY)')
            ->sum('balance_token_deposit_amount');

        $amount = ($this->balance_token_deposit - $excludedDepositSum) * $percent;

        $transaction = $this->updateBalance(TransactionType::DEPOSIT_DAILY_ACCRUAL, $amount);
        $transaction->apply();
        $transaction->createContext(json_encode(['percent' => $percent]));

        $this->makeReferralsAccrual($amount);
    }

    /**
     * Получить дерево рефералов
     *
     * @return object
     */
    public function getReferralsTree(): object
    {
        return $this->descendants()
            ->withDepth()
            ->having('depth', '<=', 8)
            ->get()
            ->toTree()
            ->pipe(function ($collection) {

                /**
                 * - установка уровня
                 * - переименование "children" в "_children", для пакета на фронте
                 *
                 * @param $referrals
                 * @param int $level
                 */
                $handle = function (&$referrals, int $level) use (&$handle) {
                    /** @var User $referral */
                    foreach ($referrals as &$referral) {
                        $referral->level = $level;
                        $referral->statDeposit = $referral->getStat()['myDeposit']();

                        $referral->_children = $referral->children;

                        unset($referral->children);

                        if ($referral->_children->isNotEmpty()) {
                            $handle($referral->_children, $level + 1);
                        }

                        unset($referral);
                    }
                };

                $handle($collection, 1);

                return $collection;
            });
    }

    /**
     * Отправить уведомление текущему пользователю
     *
     * @param string $message
     */
    public function sendNotification(string $message): void
    {
        $this->notify(new UserNotification($message));
    }

    /**
     * Отправить уведомление указанным пользователям
     *
     * @param string $message
     * @param Collection|array $users
     */
    public static function sendNotificationToMany(string $message, $users): void
    {
        Notification::send($users, new UserNotification($message));
    }

    /**
     * Генерация уникального реферального кода
     *
     * @return string
     */
    public function generateRefCode(): string
    {
        while (true) {
            $code = Str::random(8); // todo: переделать, чтобы код генерировался на основе ID пользователя

            if (!self::where('ref_code', $code)->exists()) {
                break;
            }
        }

        return $code;
    }

    /**
     * Начисление TOKEN для рефералов
     *
     * @param float $amount Сумма от которой насчитываются бонусы
     * @throws \Exception
     */
    public function makeReferralsAccrual(float $amount): void
    {
        if ($amount < 0) {
            return;
        }

        $referrals = $this->ancestors()->limit(8)->orderByDesc('id');

        /** @var User $referral */
        foreach ($referrals->get() as $referral) {
            $amount = $amount / 100 * 10; // начисление 10% каждому уровню от суммы предыдущего
            $referral->updateBalance(TransactionType::DEPOSIT_REF_BONUS, $amount)->apply();
        }
    }

    /**
     * Начисления монет и TOKEN по ранговой программе
     *
     * @return void
     */
    public function makeRankAccrual(): void
    {
        $rank = $this->rank + 1;

        if (isset(self::RANK_CONDITIONS[$rank])) {
            $condition = self::RANK_CONDITIONS[$rank];
        } else {
            return;
        }

        if (
            $condition['my_deposit'] <= $this->balance_token_deposit
            && $condition['referrals_deposit'] <= $this->getStat()['referralsDeposit']()
        ) {
            $this->rank = $rank;
            $this->save();

            $this->updateBalance(TransactionType::DEPOSIT_RANK_TOKEN, $condition['token'])->apply();
            $this->updateBalance(TransactionType::DEPOSIT_RANK_COIN, $condition['coin'])->apply();
        }
    }

    /**
     * Выборка статистики
     *
     * @return \Closure[]
     */
    public function getStat(): array
    {
        return [
            'myDeposit' => function () {
                return $this
                    ->transactions()
                    ->where(['type_id' => TransactionType::MOVE_TO_DEPOSIT])
                    ->sum('balance_token_deposit_amount');
            },
            'myAccrual' => function () {
                return $this
                    ->transactions()
                    ->where(['type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL])
                    ->sum('balance_token_amount');
            },
            'referralsDeposit' => function () {
                return Transaction::where('type_id', TransactionType::MOVE_TO_DEPOSIT)
                    ->whereIn('user_id', User::where([$this->getParentIdName() => $this->id])->select('id'))
                    ->sum('balance_token_deposit_amount');
            },
            'referralsAccrual' => function () {
                return Transaction::where('type_id', TransactionType::DEPOSIT_DAILY_ACCRUAL)
                    ->whereIn('user_id', User::where([$this->getParentIdName() => $this->id])->select('id'))
                    ->sum('balance_token_amount');
            },
        ];
    }

    /**
     * Получить действия для пользователя в круд форме админ панели
     *
     * @return string
     */
    public function getActionButtonsForAdminForm(): string
    {
        return '<a href="' . route('admin.user.login_as_user', $this->id) . '" class="btn btn-sm btn-link"><i class="la la-sign-in"></i>' . trans('admin.authorize') . '</a>';
    }
}
