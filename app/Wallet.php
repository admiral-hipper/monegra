<?php

namespace App;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

/**
 * App\Wallet
 *
 * @property int $id
 * @property int $user_id ID пользователя
 * @property int $type_id ID типа кошелька
 * @property string $number Реквизиты кошелька (например адрес крипто кошелька/номер карты)
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\WalletType $type
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet newQuery()
 * @method static \Illuminate\Database\Query\Builder|Wallet onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wallet whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Wallet withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Wallet withoutTrashed()
 * @mixin \Eloquent
 */
class Wallet extends Model
{
    use SoftDeletes;

    /** @inheritDoc */
    protected $fillable = [
        'user_id',
        'type_id',
        'number',
    ];

    /**
     * Тип
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(WalletType::class);
    }
}
