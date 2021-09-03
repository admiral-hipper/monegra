<?php

namespace App\Http\Controllers\Admin;

use App\{RateHistory, User, Transaction, TransactionType, CoinOrder};
use App\Http\Controllers\Controller;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Получить статистику
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getStats(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'date_range' => 'bail|required|array|size:2',
        ]);

        $dateRange = [
            Carbon::createFromFormat('Y-m-d', $requestData['date_range'][0])->startOfDay(),
            Carbon::createFromFormat('Y-m-d', $requestData['date_range'][1])->endOfDay()
        ];

        $values = $this->getValuesForStats($dateRange);

        $groupedStats = [
            [
                'title' => trans('admin.balances'),
                'items' => [
                    [
                        'value' => $values['balance_token_and_deposit_token_sum'],
                        'label' => trans('admin.balance_token_and_deposit_token_sum'),
                    ],
                    [
                        'value' => $values['balance_token_sum'],
                        'label' => trans('admin.balance_token_sum'),
                    ],
                    [
                        'value' => $values['balance_token_deposit_sum'],
                        'label' => trans('admin.balance_token_deposit_sum'),
                    ],
                    [
                        'value' => $values['balance_coin_sum'],
                        'label' => trans('admin.balance_coin_sum'),
                    ],
                ],
            ],
            [
                'title' => trans('admin.purchase'),
                'items' => [
                    [
                        'value' => $values['total_tokens_bought'],
                        'label' => trans('admin.total_tokens_bought'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['total_tokens_bought_with_payeer'],
                        'label' => trans('admin.total_tokens_bought_with_payeer'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['total_tokens_bought_with_pm'],
                        'label' => trans('admin.total_tokens_bought_with_pm'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['total_tokens_bought_with_btc'],
                        'label' => trans('admin.total_tokens_bought_with_btc'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['total_tokens_bought_with_eth'],
                        'label' => trans('admin.total_tokens_bought_with_eth'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['total_tokens_bought_with_pzm'],
                        'label' => trans('admin.total_tokens_bought_with_pzm'),
                        'period_dependent' => true,
                    ],
                ],
            ],
            [
                'title' => trans('admin.sale'),
                'items' => [
                    [
                        'value' => $values['total_withdrawn_in_dollars'],
                        'label' => trans('admin.total_withdrawn_in_dollars'),
                    ],
                    [
                        'value' => $values['total_dividends_paid'],
                        'label' => trans('admin.total_dividends_paid'),
                    ],
                    [
                        'value' => $values['total_dividends_paid_on_affiliate_programs'],
                        'label' => trans('admin.total_dividends_paid_on_affiliate_programs'),
                    ],
                    [
                        'value' => $values['total_tokens_sold'],
                        'label' => trans('admin.total_tokens_sold'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['sent_gold_coins'],
                        'label' => trans('admin.sent_gold_coins'),
                        'period_dependent' => true,
                    ],
                ],
            ],
            [
                'title' => trans('admin.users'),
                'items' => [
                    [
                        'value' => $values['number_of_users_with_verified_emails'],
                        'label' => trans('admin.number_of_users_with_verified_emails'),
                    ],
                    [
                        'value' => $values['number_of_users_registered_by_affiliate_links'],
                        'label' => trans('admin.number_of_users_registered_by_affiliate_links'),
                    ],
                    [
                        'value' => $values['number_of_users_registered_without_affiliate_links'],
                        'label' => trans('admin.number_of_users_registered_without_affiliate_links'),
                    ],
                    [
                        'value' => $values['top_users_with_high_turnover_on_first_line'],
                        'label' => trans('admin.top_users_with_high_turnover_on_first_line'),
                    ],
                    [
                        'value' => $values['top_users_who_bought_the_most_tokens'],
                        'label' => trans('admin.top_users_who_bought_the_most_tokens'),
                    ],
                ],
            ],
            [
                'title' => trans('admin.other'),
                'items' => [
                    [
                        'value' => $values['total_transferred_to_deposit_balance'],
                        'label' => trans('admin.total_transferred_to_deposit_balance'),
                    ],
                    [
                        'value' => $values['gold_coins_earned'],
                        'label' => trans('admin.gold_coins_earned'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['asset_growth_in_percentage'],
                        'label' => trans('admin.asset_growth_in_percentage'),
                        'period_dependent' => true,
                    ],
                    [
                        'value' => $values['number_of_interest_paid_on_deposit_to_clients'],
                        'label' => trans('admin.number_of_interest_paid_on_deposit_to_clients'),
                        'period_dependent' => true,
                    ],
                ],
            ],
        ];

        return response()->json($groupedStats);
    }

    /**
     * Получить значения для статистики
     *
     * @param array $dateRange
     * @return array
     */
    private function getValuesForStats(array $dateRange): array
    {
        $values = [];

        $balanceValues = User::query()
            ->selectRaw('SUM(balance_token) as balance_token_sum, SUM(balance_token_deposit) as balance_token_deposit_sum, SUM(balance_coin) as balance_coin_sum')
            ->first();

        $values['balance_token_and_deposit_token_sum'] = number_format($balanceValues->balance_token_sum + $balanceValues->balance_token_deposit_sum, 2) . ' RTL';
        $values['balance_token_sum'] = number_format($balanceValues->balance_token_sum, 2) . ' RTL';
        $values['balance_token_deposit_sum'] = number_format($balanceValues->balance_token_deposit_sum, 2) . ' RTL';
        $values['balance_coin_sum'] = number_format($balanceValues->balance_coin_sum, 0) . ' RGP';

        $purchaseValues = ['all' => ['token_amount' => 0]];

        foreach (Transaction::where('status', Transaction::STATUS_SUCCESS)
                     ->whereBetween('updated_at', $dateRange)
                     ->whereIn('type_id', [
                         TransactionType::DEPOSIT_PAYEER,
                         TransactionType::DEPOSIT_PM,
                         TransactionType::DEPOSIT_BTC,
                         TransactionType::DEPOSIT_ETH,
                         TransactionType::DEPOSIT_PZM,
                     ])
                     ->select(['type_id', 'balance_token_amount', 'amount'])
                     ->get() as &$transaction) {
            if (!isset($purchaseValues[$transaction->type_id])) {
                $purchaseValues[$transaction->type_id] = ['token_amount' => 0, 'amount' => 0];
            }

            $purchaseValues[$transaction->type_id]['token_amount'] += $transaction->balance_token_amount;
            $purchaseValues[$transaction->type_id]['amount'] += $transaction->amount;
            $purchaseValues['all']['token_amount'] += $transaction->balance_token_amount;

            unset($transaction);
        }

        $values['total_tokens_bought'] = number_format($purchaseValues['all']['token_amount'], 2) . ' RTL';
        $values['total_tokens_bought_with_payeer'] = number_format($purchaseValues[TransactionType::DEPOSIT_PAYEER]['token_amount'] ?? 0, 2) . ' RTL (' . number_format($purchaseValues[TransactionType::DEPOSIT_PAYEER]['amount'] ?? 0, 2) . ' USD)';
        $values['total_tokens_bought_with_pm'] = number_format($purchaseValues[TransactionType::DEPOSIT_PM]['token_amount'] ?? 0, 2) . ' RTL (' . number_format($purchaseValues[TransactionType::DEPOSIT_PM]['amount'] ?? 0, 2) . ' USD)';
        $values['total_tokens_bought_with_btc'] = number_format($purchaseValues[TransactionType::DEPOSIT_BTC]['token_amount'] ?? 0, 2) . ' RTL (' . number_format($purchaseValues[TransactionType::DEPOSIT_BTC]['amount'] ?? 0, 4) . ' BTC)';
        $values['total_tokens_bought_with_eth'] = number_format($purchaseValues[TransactionType::DEPOSIT_ETH]['token_amount'] ?? 0, 2) . ' RTL (' . number_format($purchaseValues[TransactionType::DEPOSIT_ETH]['amount'] ?? 0, 4) . ' ETH)';
        $values['total_tokens_bought_with_pzm'] = number_format($purchaseValues[TransactionType::DEPOSIT_PZM]['token_amount'] ?? 0, 2) . ' RTL (' . number_format($purchaseValues[TransactionType::DEPOSIT_PZM]['amount'] ?? 0, 4) . ' PZM)';

        $withdrawalSums = Transaction::where('status', Transaction::STATUS_SUCCESS)
            ->whereBetween('updated_at', $dateRange)
            ->whereIn('type_id', [
                TransactionType::WITHDRAW_PAYEER,
                TransactionType::WITHDRAW_PM,
                TransactionType::WITHDRAW_BTC,
                TransactionType::WITHDRAW_ETH,
                TransactionType::WITHDRAW_PZM,
            ])
            ->selectRaw('SUM(balance_token_amount) as token_sum, SUM(amount_usd) as usd_sum')
            ->first();

        $values['total_tokens_sold'] = number_format(abs($withdrawalSums->token_sum), 2) . ' RTL';
        $values['total_withdrawn_in_dollars'] = number_format(abs($withdrawalSums->usd_sum), 2) . ' RTL';

        $values['total_dividends_paid'] = number_format(abs(Transaction::where('status', Transaction::STATUS_SUCCESS)
                ->whereIn('type_id', [
                    TransactionType::DEPOSIT_DAILY_ACCRUAL,
                    TransactionType::DEPOSIT_REF_BONUS,
                    TransactionType::DEPOSIT_RANK_TOKEN,
                ])
                ->sum('balance_token_amount')), 2) . ' RTL';

        $values['total_dividends_paid_on_affiliate_programs'] = number_format(abs(Transaction::where('status', Transaction::STATUS_SUCCESS)
                ->whereIn('type_id', [
                    TransactionType::DEPOSIT_REF_BONUS,
                    TransactionType::DEPOSIT_RANK_TOKEN,
                ])
                ->sum('balance_token_amount')), 2) . ' RTL';

        $values['sent_gold_coins'] = (int)CoinOrder::query()
                ->whereBetween('created_at', $dateRange)
                ->sum('coin_amount') . ' RGP';

        $values['number_of_users_with_verified_emails'] = User::whereNotNull('email_verified_at')->count();
        $values['number_of_users_registered_by_affiliate_links'] = User::whereNotNull('ref_parent_id')->count();
        $values['number_of_users_registered_without_affiliate_links'] = User::whereNull('ref_parent_id')->count();

        $values['top_users_with_high_turnover_on_first_line'] = '---';

        $values['top_users_who_bought_the_most_tokens'] = Transaction::where('status', Transaction::STATUS_SUCCESS)
            ->whereIn('type_id', [
                TransactionType::DEPOSIT_PAYEER,
                TransactionType::DEPOSIT_PM,
                TransactionType::DEPOSIT_BTC,
                TransactionType::DEPOSIT_ETH,
                TransactionType::DEPOSIT_PZM,
            ])
            ->select(['user_id', \DB::raw('SUM(balance_token_amount) as token_amount')])
            ->groupBy('user_id')
            ->orderByDesc('token_amount')
            ->limit(10)
            ->get()
            ->load('user:id,name')
            ->pluck('token_amount', 'user.name')
            ->pipe(function ($collection) {
                $html = '<code style="color: #7c6aef;">';

                foreach ($collection as $userName => &$tokenAmount) {
                    $html .= "<div style='margin-top: 3px; margin-left: 3px; line-height: 1; font-size: 90%;'>{$userName}: {$tokenAmount} RTL</div>";

                    unset($userName, $tokenAmount);
                }

                $html .= '</code>';

                return $html;
            });

        $values['total_transferred_to_deposit_balance'] = number_format(abs(Transaction::where('status', Transaction::STATUS_SUCCESS)
                ->where('type_id', TransactionType::MOVE_TO_DEPOSIT)
                ->sum('balance_token_amount')), 2) . ' RTL';

        $values['gold_coins_earned'] = Transaction::where('status', Transaction::STATUS_SUCCESS)
                ->whereBetween('updated_at', $dateRange)
                ->where('type_id', TransactionType::DEPOSIT_RANK_COIN)
                ->where('balance_coin_amount', '>', 0)
                ->sum('balance_coin_amount') . ' RGP';

        $oldestRate = RateHistory::query()
                ->whereBetween('created_at', $dateRange)
                ->select('rate')
                ->oldest()
                ->first()->rate ?? 0;

        $latestRate = RateHistory::query()
                ->whereBetween('created_at', $dateRange)
                ->select('rate')
                ->latest()
                ->first()->rate ?? 0;

        $values['asset_growth_in_percentage'] = (!$oldestRate ? 0 : number_format(($latestRate * 100) / $oldestRate - 100, 2)) . ' %';

        $values['number_of_interest_paid_on_deposit_to_clients'] = number_format(abs(Transaction::where('status', Transaction::STATUS_SUCCESS)
                ->whereBetween('updated_at', $dateRange)
                ->where('type_id', TransactionType::DEPOSIT_DAILY_ACCRUAL)
                ->sum('balance_token_deposit_amount')), 2) . ' RTL';

        return $values;
    }
}
