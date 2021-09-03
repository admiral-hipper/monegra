<?php

namespace App\Http\Controllers\Cabinet;

use App\{Currency, Services\Telegram\Bot, Transaction, TransactionType, User, Wallet};
use App\Notifications\ConfirmWithdrawal;
use App\Http\Traits\TransactionTable;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\{Request, JsonResponse, Response};
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    use TransactionTable;

    private $transactionTypeIdsForTable = [
        TransactionType::WITHDRAW_PM,
        TransactionType::WITHDRAW_PAYEER,
        TransactionType::WITHDRAW_BTC,
        TransactionType::WITHDRAW_ETH,
        TransactionType::WITHDRAW_PZM,
    ];

    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        /** @var User $authUser */
        $authUser = \Auth::user();

        $internalCurrencyCode = Currency::find(Currency::RTL)->code;

        $userBalanceState = $authUser->balance_token . " {$internalCurrencyCode}";

        $userWallets = $authUser->wallets()->with('type.currency:id,code')->get();

        $linkToWallets = route('cabinet.wallet');

        $rateSell = Currency::modifyForSell(Currency::getRate());
        $rateSellUsd = Currency::getRate(Currency::PAIR_RTL_USD, 1, $rateSell);
        $quotes = Currency::getRates(Currency::PAIRS_RTL, 1, $rateSell);

        return view('cabinet.withdraw', compact(
            'userBalanceState',
            'userWallets',
            'linkToWallets',
            'rateSell',
            'rateSellUsd',
            'quotes'
        ));
    }

    /**
     * Получить информацию для транзакции
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getInfoForTransaction(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'wallet_id' => 'bail|required|exists:wallets,id',
            'amount' => 'required|numeric|min:0',
        ]);

        /** @var User $authUser */
        $authUser = \Auth::user();

        $userWallet = $authUser
            ->wallets()
            ->with('type.currency:id,code,name_en')
            ->findOrFail($requestData['wallet_id']);

        $pairName = Currency::getPairName($userWallet->type->currency->code);
        $tokenRateSell = Currency::modifyForSell(Currency::getRate());
        $tokenAmount = Currency::getRate($pairName, $requestData['amount'], $tokenRateSell);
        $userBalanceToken = $authUser->balance_token;

        if (!$tokenAmount) {
            return response()->json('Failed to request cryptocurrency data', Response::HTTP_FAILED_DEPENDENCY);
        }

        if ($tokenAmount > $userBalanceToken) {
            return response()->json('Недостаточно средств', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $responseData = [
            'user_balance_state' => "{$userBalanceToken} " . Currency::CODE_RTL,
            'amount_to_hold' => "{$tokenAmount} " . Currency::CODE_RTL,
            'user_wallet' => $userWallet,
        ];

        if ($userWallet->type->currency->id !== Currency::USD) {
            $currencyCode = $userWallet->type->currency->code;
            $coinPriceInUSD = Currency::getRate($userWallet->type->currency_id);

            $responseData['currency_rate'] = "1 {$currencyCode} = \${$coinPriceInUSD}";
        }

        return response()->json($responseData);
    }

    /**
     * Отправить код для подтверждения транзакции
     *
     * @return JsonResponse
     */
    public function sendVerificationCode(): JsonResponse
    {
        \Auth::user()->notify(new ConfirmWithdrawal);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Создать транзакцию на вывод
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function createTransaction(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'wallet_id' => 'bail|required|exists:wallets,id',
            'verification_code' => 'required|integer|min:10000|max:99999',
            'amount' => 'required|numeric|min:0',
        ]);

        /** @var User $authUser */
        $authUser = $request->user();

        if ((int)$requestData['verification_code'] !== $authUser->getVerificationCode('withdrawal')) {
            return response()->json('Код подтверждения недействителен', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var Wallet $userWallet */
        $userWallet = $authUser
            ->wallets()
            ->with('type.currency:id,code,name_en')
            ->findOrFail($requestData['wallet_id']);

        $pairName = Currency::getPairName($userWallet->type->currency->code);
        $tokenRateSell = Currency::modifyForSell(Currency::getRate());
        $transactionAmount = Currency::getRate($pairName, $requestData['amount'], $tokenRateSell);
        $userBalanceToken = $authUser->balance_token;

        if ($transactionAmount > $userBalanceToken) {
            return response()->json('Недостаточно средств', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        DB::transaction(function () use ($authUser, $userWallet, $requestData) {
            $typeId = TransactionType::getTypeIdByWallet($userWallet, 'withdraw');
            $transaction = $authUser->updateBalance($typeId, (float)$requestData['amount']);
            $transaction->apply(Transaction::STATUS_WAIT);
            $transaction->wallets()->attach($userWallet);
            Bot::sendTransactionNotifyToAdmin($transaction);

            $authUser->eraseVerificationCode('withdrawal');
        }, 2);

        return response()->json([
            'internal_currency_amount' => $transactionAmount,
            'internal_currency_code' => Currency::CODE_RTL,
            'user_balance_state' => "{$authUser->fresh()->balance_token} " . Currency::CODE_RTL,
            'link_to_transactions' => route('cabinet.transaction'),
        ], Response::HTTP_CREATED);
    }
}
