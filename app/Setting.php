<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Setting
 *
 * @package App
 * @property string $name
 * @property mixed $value
 * @mixin \Eloquent
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 */
class Setting extends Model
{
    const ACCRUAL_PERCENT_RANGE = 'accrual_percent_range';

    /** @var float[][] значения по умолчанию */
    public static $defaults = [
        'accrual_percent_range' => [0.01, 0.5],
    ];

    /** @var string ключ кэша последнего начисляемого процента */
    public static $cacheLastAccrualPercentKey = 'setting:last_accrual_percent';

    /** @inheritDoc */
    public $timestamps = false;

    /** @inheritDoc */
    protected $fillable = [
        'name',
        'value',
    ];

    /** @inheritDoc */
    protected $casts = [
        'value' => 'json',
    ];

    /**
     * Установить диапазон начисляемого процента
     *
     * @param float $from
     * @param float $to
     */
    public static function setAccrualPercentRange(float $from, float $to): void
    {
        self::updateOrCreate(
            ['name' => self::ACCRUAL_PERCENT_RANGE],
            ['value' => [$from, $to]]
        );
    }

    /**
     * Получить диапазон начисляемого процента
     *
     * @param bool $assoc
     * @return array
     */
    public static function getAccrualPercentRange(bool $assoc = false): array
    {
        $setting = self::firstWhere('name', self::ACCRUAL_PERCENT_RANGE);

        if ($setting) {
            $accrualPercentRange = $setting->value;
        } else {
            $accrualPercentRange = self::$defaults['accrual_percent_range'];
        }

        if ($assoc) {
            return [
                'from' => $accrualPercentRange[0],
                'to' => $accrualPercentRange[1],
            ];
        }

        return $accrualPercentRange;
    }

    /**
     * Установить последний использованный процент начисления
     *
     * @param float $percent
     */
    public static function setLastUsedAccrualPercent(float $percent): void
    {
        \Cache::put(Setting::$cacheLastAccrualPercentKey, $percent);
    }

    /**
     * Получить последний использованный процент начисления
     *
     * @return float|null
     */
    public static function getLastUsedAccrualPercent(): ?float
    {
        return \Cache::get(Setting::$cacheLastAccrualPercentKey);
    }
}
