<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionType;
use App\User;

class StatController extends Controller
{
    public function index()
    {
        $user = \Auth::user();

        $subQueryReferrals = function ($query) use ($user) {
            $query->select('id')->from('users')->where('ref_parent_id', $user->id);
        };

        $stat = [
            // всего в наличии RTL
            'totalRtl' => $user->balance_token + $user->balance_token_deposit,
            // всего на основном балансе RTL
            'totalGeneralRtl' => $user->balance_token,
            // всего на депозитном балансе RTL
            'totalDepositRtl' => $user->balance_token_deposit,
            // всего куплено RTL
            'totalRtlBuy' => $user->transactions()
                ->where('status', Transaction::STATUS_SUCCESS)
                ->whereIn('type_id', TransactionType::DEPOSIT_TYPES)
                ->sum('balance_token_amount'),
            // всего продано RTL
            'totalRtlSell' => abs($user->transactions()
                ->where('status', Transaction::STATUS_SUCCESS)
                ->whereIn('type_id', TransactionType::WITHDRAW_TYPES)
                ->sum('balance_token_amount')),
            // получено дивидендов RTL
            'totalRtlAccrual' => $user->transactions()->where([
                'type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL,
                'status' => Transaction::STATUS_SUCCESS,
            ])->sum('balance_token_deposit_amount'),
            // получено дивидендов USD
            'totalUsdAccrual' => $user->transactions()->where([
                'type_id' => TransactionType::DEPOSIT_DAILY_ACCRUAL,
                'status' => Transaction::STATUS_SUCCESS,
            ])->sum('amount_usd'),
            // количество рефералов
            'myReferralsCount' => $user->referralsCount(),
            // общее количество рефералов всех уровней
            'myReferralsCountTotal' => count($user->descendants()->withDepth()->having('depth', '<=', 8)->get()),
            // оборот 1й линии рефералов
            'myReferralsDeposit' => Transaction
                ::where([
                    'type_id' => TransactionType::MOVE_TO_DEPOSIT,
                    'status' => Transaction::STATUS_SUCCESS,
                ])
                ->whereIn('user_id', $subQueryReferrals)
                ->sum('balance_token_deposit_amount'),
            // получено золотых монет рефералами 1й линии
            'myReferralsCoinCount' => Transaction
                ::where([
                    'type_id' => TransactionType::DEPOSIT_RANK_COIN,
                    'status' => Transaction::STATUS_SUCCESS,
                ])
                ->whereIn('user_id', $subQueryReferrals)
                ->sum('balance_coin_amount'),
            // сумма расчетного баланса рефералов 1й линии
            'myReferralsBalanceToken' => User
                ::whereIn('id', $subQueryReferrals)
                ->sum('balance_token'),
            // сумма депозитного баланса рефералов 1й линии
            'myReferralsBalanceTokenDeposit' => User
                ::whereIn('id', $subQueryReferrals)
                ->sum('balance_token_deposit')
        ];

        return view('cabinet.stat', [
            'stat' => $stat,
        ]);
    }
}
