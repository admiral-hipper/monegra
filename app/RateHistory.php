<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\RateHistory
 *
 * @property int $id
 * @property float $rate Курс монеты
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory whereRate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RateHistory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class RateHistory extends Model
{
    const PERIOD_15M = '15m';
    const PERIOD_DAY = 'day';
    const PERIOD_MONTH = 'month';
    const PERIOD_YEAR = 'year';

    /** @inheritDoc */
    protected $fillable = [
        'rate',
    ];

    /** @inheritDoc */
    protected $table = 'rate_history';

    /**
     * Получение истории изменения курса токена с группировкой
     *
     * @param string $period
     * @return array
     */
    public static function getHistoryByPeriod(string $period = self::PERIOD_DAY): array
    {
        $dateFormat = 'Y-m-d';
        $selectSql = 'MAX(rate) as rate, MAX(DATE(created_at)) as date';

        switch ($period) {
            case self::PERIOD_15M:
                $selectSql = 'MAX(rate) as rate, MAX(created_at) as date';
                $groupSql = 'created_at';
                $dateFrom = Carbon::now()->subHours(24)->format($dateFormat);
                break;
            case self::PERIOD_DAY:
                $groupSql = 'DATE(created_at)';
                $dateFrom = Carbon::now()->subDays(30)->format($dateFormat);
                break;
            case self::PERIOD_MONTH:
                $groupSql = 'MONTH(created_at)';
                $dateFrom = Carbon::now()->subMonths(12)->format($dateFormat);
                break;
            case self::PERIOD_YEAR:
                $groupSql = 'YEAR(created_at)';
                $dateFrom = Carbon::now()->subYears(5)->format($dateFormat);
                break;
            default:
                throw new \InvalidArgumentException('Invalid period.');
        }

        return self::selectRaw($selectSql)
            ->where('created_at', '>=', $dateFrom)
            ->groupByRaw($groupSql)
            ->get()
            ->toArray();
    }
}
