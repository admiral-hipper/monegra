<?php

namespace App;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * App\CoinOrder
 *
 * @property int $id ID заявки
 * @property int $transaction_id ID транзакции
 * @property int $user_id ID пользователя
 * @property string $full_name Имя получателя
 * @property string $address Адрес
 * @property string $phone Телефон
 * @property int $coin_amount Количество монет
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Transaction $transaction
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder query()
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereCoinAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CoinOrder whereUserId($value)
 * @mixin \Eloquent
 */
class CoinOrder extends Model
{
    use CrudTrait;

    /** @inheritDoc */
    protected $fillable = [
        'transaction_id',
        'user_id',
        'full_name',
        'address',
        'phone',
        'coin_amount',
    ];

    /**
     * Получение транзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Получение пользователя
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Получить действия для заявки в круд форме админ панели
     *
     * @return string
     */
    public function getActionButtonsForAdminForm(): string
    {
        if (!$this->transaction->needManualHandling()) {
            return '-';
        }

        return '<div>'
            . '<a href="' . route('/transaction.index', ['id' => $this->transaction->id]) . '" class="btn btn-info btn-sm btn-block" style="color: #fff; cursor: pointer;">' . trans('admin.transaction') . '</a>'
            . '</div>';
    }
}
