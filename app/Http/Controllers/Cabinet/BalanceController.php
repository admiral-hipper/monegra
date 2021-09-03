<?php

namespace App\Http\Controllers\Cabinet;

use App\{Currency, TransactionType};
use App\Http\Traits\TransactionTable;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\{Request, JsonResponse, Response};
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    use TransactionTable;

    private $transactionTypeIdsForTable = [
        TransactionType::MOVE_TO_DEPOSIT,
        TransactionType::MOVE_FROM_DEPOSIT,
    ];

    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        $internalCurrencyCode = Currency::find(Currency::RTL)->code;
        $userBalanceState = \Auth::user()->balance_token . " {$internalCurrencyCode}";
        $userDepositBalanceState = \Auth::user()->balance_token_deposit . " {$internalCurrencyCode}";
        $canUserWithdrawDeposit = $this->canUserWithdrawDeposit();
        $maxDepositWithdrawAmount = !$canUserWithdrawDeposit ? 0 : $this->getMaxDepositWithdrawAmount();

        return view('cabinet.balance', compact(
            'userBalanceState',
            'userDepositBalanceState',
            'canUserWithdrawDeposit',
            'maxDepositWithdrawAmount'
        ));
    }

    /**
     * Перевод между балансами
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function transferBetweenBalances(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'balance_type' => 'bail|required|string|in:balance_token,balance_token_deposit',
            'amount' => 'required|numeric|min:0',
        ]);

        $toBalanceType = $requestData['balance_type'];
        $fromBalanceType = $toBalanceType === 'balance_token' ? 'balance_token_deposit' : 'balance_token';
        $isTransferFromDepositBalance = $fromBalanceType === 'balance_token_deposit';

        $authUser = \Auth::user();

        if ($isTransferFromDepositBalance) {
            if (!$this->canUserWithdrawDeposit()) {
                logger()->warning('Произошла попытка вывода средств с депозититного баланса при активном ограничении на вывод (ID пользователя - ' . \Auth::id() . ')');

                return response()->json(__('Restriction on withdrawal of funds from the deposit balance is active'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            if ($this->getMaxDepositWithdrawAmount() < $requestData['amount']) {
                logger()->info('Произошла попытка вывода средств с депозитного баланса с суммой больше разрешенной (ID пользователя - ' . \Auth::id() . ')');

                return response()->json(__('You cannot withdraw more than the allowed amount'), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
        }

        if ($authUser->{$fromBalanceType} < $requestData['amount']) {
            logger()->info('Произошла попытка перевода между балансами с указанной суммой больше, чем у пользователя на выбранном балансе (ID пользователя - ' . \Auth::id() . ')');

            return response()->json(__('Insufficient funds'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        DB::transaction(function () use ($requestData, $fromBalanceType, $toBalanceType) {
            $transactionTypeId = $toBalanceType === 'balance_token'
                ? TransactionType::MOVE_FROM_DEPOSIT
                : TransactionType::MOVE_TO_DEPOSIT;

            $transaction = \Auth::user()->updateBalance($transactionTypeId, $requestData['amount']);
            $transaction->apply();
        }, 2);

        $internalCurrencyCode = Currency::find(Currency::RTL)->code;

        $authUser = \Auth::user()->fresh();

        return response()->json([
            'user_balance_state' => "{$authUser->balance_token} {$internalCurrencyCode}",
            'user_deposit_balance_state' => "{$authUser->balance_token_deposit} {$internalCurrencyCode}",
            'can_user_withdraw_deposit' => $this->canUserWithdrawDeposit(),
        ]);
    }

    /**
     * Определить, может ли пользователь делать перевод с депозитного баланса
     *
     * @return bool
     */
    private function canUserWithdrawDeposit(): bool
    {
        return !\Auth::user()
            ->transactions()
            ->where('type_id', TransactionType::MOVE_FROM_DEPOSIT)
            ->whereDate('created_at', '>=', now()->startOfWeek()->format('Y-m-d'))
            ->exists();
    }

    /**
     * Получить максимальную разрешенную сумму для вывода с депозитного баланса
     *
     * @return float
     */
    private function getMaxDepositWithdrawAmount(): float
    {
        $percent = 8;

        return \Auth::user()->balance_token_deposit * "0.0{$percent}";
    }
}
