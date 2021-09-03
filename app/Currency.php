<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

/**
 * App\Currency
 *
 * @property int $id
 * @property string $code Уникальнй код валюты
 * @property string $name_ru Название (русский)
 * @property string $name_en Название (английский)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereNameEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereNameRu($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    const RTL = 1; // PAIR_RTL_XAU (внутренний TOKEN)
    const USD = 2;
    const BTC = 3; // PAIR_BTC_USD
    const ETH = 4; // PAIR_ETH_USD
    const PZM = 5; // PAIR_PZM_USD
    const XAU = 6; // PAIR_XAU_USD (тройская унция золота)
    const RGP = 7; // золотая монета

    // коды валют
    const CODE_RTL = 'RTL';
    const CODE_USD = 'USD';
    const CODE_BTC = 'BTC';
    const CODE_ETH = 'ETH';
    const CODE_PZM = 'PZM';
    const CODE_XAU = 'XAU';
    const CODE_RGP = 'RGP';

    // USD
    const PAIR_USD_RTL = 'USD/RTL';
    // XAU
    const PAIR_XAU_USD = 'XAU/USD';
    // BTC
    const PAIR_BTC_USD = 'BTC/USD';
    const PAIR_BTC_RTL = 'BTC/RTL';
    // ETH
    const PAIR_ETH_USD = 'ETH/USD';
    const PAIR_ETH_RTL = 'ETH/RTL';
    // PZM
    const PAIR_PZM_USD = 'PZM/USD';
    const PAIR_PZM_RTL = 'PZM/RTL';
    // RTL
    const PAIR_RTL_USD = 'RTL/USD';
    const PAIR_RTL_XAU = 'RTL/XAU';
    const PAIR_RTL_BTC = 'RTL/BTC';
    const PAIR_RTL_ETH = 'RTL/ETH';
    const PAIR_RTL_PZM = 'RTL/PZM';

    /** @var string[] Список доступных пар */
    const PAIRS = [
        self::PAIR_USD_RTL,
        self::PAIR_XAU_USD,
        self::PAIR_BTC_USD,
        self::PAIR_BTC_RTL,
        self::PAIR_ETH_USD,
        self::PAIR_ETH_RTL,
        self::PAIR_PZM_USD,
        self::PAIR_PZM_RTL,
        self::PAIR_RTL_USD,
        self::PAIR_RTL_XAU,
        self::PAIR_RTL_BTC,
        self::PAIR_RTL_ETH,
        self::PAIR_RTL_PZM,
    ];

    /** @var string[] Пары для конвертации в RTL */
    const PAIRS_RTL = [
        self::PAIR_USD_RTL,
        self::PAIR_BTC_RTL,
        self::PAIR_ETH_RTL,
        self::PAIR_PZM_RTL,
    ];

    /** @var string[] Пары, которые получаются удаленно */
    const PAIRS_REMOTE = [
        self::PAIR_XAU_USD,
        self::PAIR_BTC_USD,
        self::PAIR_ETH_USD,
        self::PAIR_PZM_USD,
    ];

    /** @inheritDoc */
    protected $fillable = [
        'key',
        'name_ru',
        'name_en',
    ];

    /**
     * Получение курса выбранной пары или валюты с возможностью указать нужное количество для конвертации
     *
     * ```
     * getRate('XAU/USD', 10)  => 10 XAU in USD
     * getRate('USD/RTL', 100) => 100 USD in RTL
     * getRate('RTL/XAU')      => 1 RTL in XAU
     * ```
     *
     * @param string|int $pair
     * @param float $amount
     * @param float|null $tokenRate
     * @return float
     */
    public static function getRate($pair = self::PAIR_RTL_XAU, float $amount = 1.0, float $tokenRate = null): ?float
    {
        static $pairRates = [];

        $cacheKey = $pair . $amount . $tokenRate;
        if (isset($pairRates[$cacheKey])) {
            return $pairRates[$cacheKey];
        }

        switch ($pair) {
            // USD
            case self::PAIR_USD_RTL:
                $pairRate = 1 / self::getRate(self::PAIR_RTL_USD, 1, $tokenRate);
                break;

            // XAU
            case self::XAU:
            case self::PAIR_XAU_USD:
                $pairRate = self::parseRateInUsd('XAU');
                break;

            // BTC
            case self::BTC:
            case self::PAIR_BTC_USD:
                $pairRate = self::parseRateInUsd('BTC');
                break;
            case self::PAIR_BTC_RTL:
                $pairRate = self::getRate(self::PAIR_USD_RTL, self::getRate(self::PAIR_BTC_USD), $tokenRate);
                break;

            // ETH
            case self::ETH:
            case self::PAIR_ETH_USD:
                $pairRate = self::parseRateInUsd('ETH');
                break;
            case self::PAIR_ETH_RTL:
                $pairRate = self::getRate(self::PAIR_USD_RTL, self::getRate(self::PAIR_ETH_USD), $tokenRate);
                break;

            // PZM
            case self::PZM:
            case self::PAIR_PZM_USD:
                $pairRate = self::parseRateInUsd('PZM');
                break;
            case self::PAIR_PZM_RTL:
                $pairRate = self::getRate(self::PAIR_USD_RTL, self::getRate(self::PAIR_PZM_USD), $tokenRate);
                break;

            // RTL
            case self::PAIR_RTL_USD:
                $pairRate = self::getRate(self::PAIR_XAU_USD) * self::getRate(self::PAIR_RTL_XAU, 1, $tokenRate);
                break;
            case self::RTL:
            case self::PAIR_RTL_XAU:
                if ($tokenRate !== null) {
                    return $tokenRate;
                }
                $pairRate = self::calculateTokenRate();
                break;
            case self::PAIR_RTL_BTC:
                $pairRate = 1 / self::getRate(self::PAIR_BTC_RTL, 1, $tokenRate);
                break;
            case self::PAIR_RTL_ETH:
                $pairRate = 1 / self::getRate(self::PAIR_ETH_RTL, 1, $tokenRate);
                break;
            case self::PAIR_RTL_PZM:
                $pairRate = 1 / self::getRate(self::PAIR_PZM_RTL, 1, $tokenRate);
                break;

            default:
                throw new \InvalidArgumentException('Invalid pair.');
        }

        if (in_array($pair, self::PAIRS_REMOTE)) {
            $pairRates[$cacheKey] = $pairRate;
        }

        return $pairRate * $amount;
    }

    /**
     * @param array $pairs
     * @param float $amount
     * @param float|null $tokenRate
     * @return array
     */
    public static function getRates(array $pairs, float $amount = 1.0, float $tokenRate = null): array
    {
        $rates = [];

        foreach ($pairs as $pair) {
            $rates[$pair] = self::getRate($pair, $amount, $tokenRate);
        }

        return $rates;
    }

    /**
     * @param float $rate
     * @return string
     */
    public static function modifyForSell(float $rate)
    {
        return $rate * 0.86;
    }

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    public static function getPairName(string $from, string $to = self::CODE_RTL): string
    {
        return "$from/$to";
    }

    /**
     * @param string $symbol
     * @return float|null
     */
    public static function parseRateInUsd(string $symbol): ?float
    {
        if ($symbol === 'XAU') {
            return 1963.76;
            $api = Http::withHeaders([
                'x-access-token' => config('transaction.goldapi'),
            ])->get('https://www.goldapi.io/api/XAU/USD');

            $response = $api->json();

            return $response ? (float)$response['price'] : null;
        }

        $api = Http::get('https://min-api.cryptocompare.com/data/price', [
            'fsym' => $symbol,
            'tsyms' => 'USD',
            'api_key' => config('transaction.cryptocompare'),
        ]);

        $response = $api->json();

        return $response ? (float)$response['USD'] : null;
    }

    /**
     * Расчет стоимости 1 TOKEN
     *
     * @return float
     */
    public static function calculateTokenRate(): float
    {
        $costSql = '0.00001 * IFNULL(POW(115000 + SUM(balance_token + balance_token_deposit), 1/3), 1) AS cost';
        $rate = User::selectRaw($costSql)->value('cost');

        // если курс равен 0, то по умолчанию курс будет 0.01
        if ($rate === 0.0) {
            $rate = 0.01;
        }

        return $rate;
    }
}
