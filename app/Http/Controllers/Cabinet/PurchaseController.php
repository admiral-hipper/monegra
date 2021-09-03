<?php

namespace App\Http\Controllers\Cabinet;

use App\{Currency, Services\Telegram\Bot, Transaction, TransactionType, Wallet, WalletType};
use App\Services\Payments\{Payeer, PerfectMoney};
use App\Http\Traits\TransactionTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\{JsonResponse, Request, Response};
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    use TransactionTable;

    private $transactionTypeIdsForTable = [
        TransactionType::DEPOSIT_PM,
        TransactionType::DEPOSIT_PAYEER,
        TransactionType::DEPOSIT_BTC,
        TransactionType::DEPOSIT_ETH,
        TransactionType::DEPOSIT_PZM,
    ];

    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        $walletTypes = WalletType::query()->with('currency:id,code')->get();

        $quotes = Currency::getRates(Currency::PAIRS_RTL);

        return view('cabinet.purchase', compact('walletTypes', 'quotes'));
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
            'wallet_type_id' => 'bail|required|exists:wallet_types,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $walletType = WalletType::with('currency:id,code,name_en')->findOrFail($requestData['wallet_type_id']);
        $userWallet = \Auth::user()->wallets()->where('type_id', $walletType->id)->first();

        if (!$userWallet) {
            return response()->json([
                'user_wallet' => null,
                'link_to_wallets' => route('cabinet.wallet'),
            ]);
        }

        $truncateUSDAmount = function ($value) {
            if ($value < 0) {
                return ceil((string)($value * 100)) / 100;
            } else {
                return floor((string)($value * 100)) / 100;
            }
        };

        /**
         * Если больше 2-х знаков после запятой, то платежные системы (pm, ...) выбрасывают ошибку
         */
        if ($walletType->currency->id === Currency::USD) {
            $requestData['amount'] = $truncateUSDAmount($requestData['amount']);
        }

        $currencyCode = $walletType->currency->code;
        $pairName = Currency::getPairName($currencyCode);
        $internalCurrencyAmount = Currency::getRate($pairName, $requestData['amount']);

        $responseData = [
            'internal_currency_amount' => "{$internalCurrencyAmount} " . Currency::CODE_RTL,
            'user_wallet' => $userWallet,
            'link_to_wallets' => route('cabinet.wallet'),
            'amount' => (float)$requestData['amount'],
        ];

        if ($internalCurrencyAmount > 5000) {
            return response()->json(__('Maximum purchase amount per transaction - 5000 RTL'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($userWallet->type->currency->id !== Currency::USD) {
            $systemWallet = config("transaction.system_wallets.{$currencyCode}");

            if (!$systemWallet) {
                logger()->error("Не найден системный кошелек для валюты при попытке пополнения {$currencyCode}");

                return response()->json(__('System wallet for currency not found'), Response::HTTP_NOT_FOUND);
            }

            $coinPriceInUSD = Currency::getRate($walletType->currency_id);

            $responseData['system_wallet'] = $systemWallet;
            $responseData['currency_rate'] = "1 {$currencyCode} = \${$coinPriceInUSD}";
            $responseData['amount_to_transfer'] = "{$requestData['amount']} {$currencyCode} = ($" . $coinPriceInUSD * $requestData['amount'] . ')';
        } else {
            $responseData['auto_payment'] = true;
            $responseData['amount_to_transfer'] = "{$requestData['amount']} {$currencyCode}";
        }

        return response()->json($responseData);
    }

    /**
     * Создать транзакцию на пополнение
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function createTransaction(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'wallet_id' => 'bail|required|exists:wallets,id',
            'amount' => 'required|numeric|min:0',
        ]);

        /** @var Wallet $userWallet */
        $userWallet = \Auth::user()
            ->wallets()
            ->with('type.currency:id,code,name_en')
            ->findOrFail($requestData['wallet_id']);

        $pairName = Currency::getPairName($userWallet->type->currency->code);
        $transactionAmount = Currency::getRate($pairName, $requestData['amount']);

        $responseData = [
            'internal_currency_amount' => $transactionAmount,
            'internal_currency_code' => Currency::find(Currency::RTL)->code,
            'link_to_transactions' => route('cabinet.transaction'),
        ];

        DB::transaction(function () use ($userWallet, $requestData, &$responseData) {
            $amount = (float)$requestData['amount'];

            $typeId = TransactionType::getTypeIdByWallet($userWallet, 'deposit');

            $transaction = \Auth::user()->updateBalance($typeId, $amount);
            $transaction->apply(Transaction::STATUS_WAIT);
            $transaction->wallets()->attach($userWallet);

            if ($typeId === TransactionType::DEPOSIT_PAYEER) {
                $responseData['link_for_payment'] = (new Payeer)->urlForPay($transaction->id, $amount, 'Покупка RTL');
            }

            if ($typeId === TransactionType::DEPOSIT_PM) {
                $responseData['form_for_payment'] = (new PerfectMoney)->htmlForPay('Перейти к оплате', $transaction->id, $amount);
            }

            Bot::sendTransactionNotifyToAdmin($transaction);
        }, 2);


        return response()->json($responseData, Response::HTTP_CREATED);
    }
}
