<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\TransactionContext
 *
 * @property int $id
 * @property int $transaction_id ID транзакции
 * @property string|null $data Контекст
 * @property-read \App\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext query()
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TransactionContext whereTransactionId($value)
 * @mixin \Eloquent
 */
class TransactionContext extends Model
{
    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc */
    protected $fillable = [
        'transaction_id',
        'data',
    ];

    /**
     * Получение транзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo('App\Transaction');
    }
}
