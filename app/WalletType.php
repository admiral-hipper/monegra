<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\WalletType
 *
 * @property int $id
 * @property int|null $currency_id ID валюты
 * @property string $name Название платежной системы
 * @property string|null $image_path Относительный путь к логотипу платежной системы
 * @property-read \App\Currency|null $currency
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType query()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereImagePath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletType whereName($value)
 * @mixin \Eloquent
 */
class WalletType extends Model
{
    const PAYEER = 1;
    const PM = 2;
    const BTC = 3;
    const ETH = 4;
    const PZM = 5;

    /** @inheritDoc */
    protected $fillable = [
        'currency_id',
        'name',
        'image_path',
    ];

    /**
     * Тип трнзакции
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
}
