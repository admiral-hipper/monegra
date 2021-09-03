<?php

namespace App\Http\Controllers\Cabinet;

use App\Currency;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ExchangeRateController extends Controller
{
    /**
     * Открыть страницу
     *
     * @return View
     */
    public function getView(): View
    {
        $exchangeRates = [];

        foreach (Currency::PAIRS as &$pair) {
            $exchangeRates[] = [
                'name' => $pair,
                'value' => number_format(Currency::getRate($pair), 2),
            ];

            unset($pair);
        }

        return view('cabinet.exchange_rate', compact('exchangeRates'));
    }
}
