<?php

namespace App\Http\Controllers\Cabinet;

use App\{User, Currency, Transaction, TransactionType};
use App\Notifications\ConfirmCoinOrder;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\{Request, JsonResponse, Response};

class PartnershipProgramController extends Controller
{
    /**
     * Открыть страницу линейной партнерской программы
     *
     * @return View
     */
    public function getLinearView(): View
    {
        $programName = 'linear';

        $referralLink = \Auth::user()->referral_link;

        return view('cabinet.partnership_program', compact('programName', 'referralLink'));
    }

    /**
     * Открыть страницу ранговой партнерской программы
     *
     * @return View
     */
    public function getRankedView(): View
    {
        /** @var User $authUser */
        $authUser = \Auth::user();
        $programName = 'ranked';
        $userBalanceCoin = $authUser->balance_coin;

        $userBalanceCoinTotal = $authUser->transactions()
            ->where([
                'status' => Transaction::STATUS_SUCCESS,
                'type_id' => TransactionType::DEPOSIT_RANK_COIN,
            ])
            ->sum('balance_coin_amount');

        $userRank = $authUser->rank;
        $rankConditions = User::RANK_CONDITIONS;

        array_unshift($rankConditions, [
            'rank' => 0,
            'coin' => '-',
            'token' => '-',
            'my_deposit' => '-',
            'referrals_deposit' => '-',
        ]);

        if (isset($rankConditions[$userRank + 1])) {
            $userStat = $authUser->getStat();

            $rankConditions[$userRank + 1]['my_deposit'] = round($userStat['myDeposit']()) . ' ' . __('from') . ' ' . $rankConditions[$userRank + 1]['my_deposit'];
            $rankConditions[$userRank + 1]['referrals_deposit'] = round($userStat['referralsDeposit']()) . ' ' . __('from') . ' ' . $rankConditions[$userRank + 1]['referrals_deposit'];
        }

        return view('cabinet.partnership_program', compact(
            'programName',
            'userBalanceCoin',
            'userBalanceCoinTotal',
            'userRank',
            'rankConditions'
        ));
    }

    /**
     * Получить рефералов для таблицы
     *
     * @return JsonResponse
     */
    public function getReferralsForTable(): JsonResponse
    {
        $referrals = \Auth::user()->getReferralsTree();

        $columns = [
            ['title' => __('Name'), 'property' => 'name'],
            ['title' => __('Surname'), 'property' => 'surname'],
            ['title' => __('Level'), 'property' => 'level'],
            ['title' => __('Rank'), 'property' => 'rank'],
            ['title' => __('Phone'), 'property' => 'phone'],
            ['title' => __('Mail'), 'property' => 'email'],
            ['title' => __('Turnover') . ', ' . Currency::CODE_RTL, 'property' => 'statDeposit'],
            ['title' => __('Registration date'), 'property' => 'created_at'],
        ];

        return response()->json([
            'columns' => $columns,
            'rows' => $referrals,
        ]);
    }

    /**
     * Получить заявки на монеты для таблицы
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getCoinOrdersForTable(Request $request): JsonResponse
    {
        /**
         * @var $pagination Paginator
         */
        $pagination = \Auth::user()
            ->coinOrders()
            ->with('transaction:id,status')
            ->orderByDesc('updated_at')
            ->paginate($request->input('per_page') ?? 10);

        $currentPage = $pagination->currentPage();
        $nextPage = $pagination->hasMorePages()
            ? $currentPage + 1
            : null;

        $items = $pagination->items();

        $columns = [
            __('Full name'),
            __('Address'),
            __('Phone'),
            __('Number of coins'),
            __('Status'),
            __('Changed'),
        ];

        $rows = [];

        foreach ($items as &$item) {
            $rows[] = [
                ['id' => $item->id, 'hidden' => true],
                ['value' => $item->full_name],
                ['value' => $item->address],
                ['value' => $item->phone],
                ['value' => $item->coin_amount],
                ['value' => trans('cabinet.transaction_statuses.' . $item->transaction->status)],
                ['value' => $item->updated_at ? $item->updated_at->format('d.m.Y H:i') : '-'],
            ];

            unset($item);
        }

        unset($items);

        return response()->json([
            'previous_page' => $currentPage - 1,
            'current_page' => $currentPage,
            'next_page' => $nextPage,
            'last_page' => $pagination->lastPage(),
            'per_page' => (int)$pagination->perPage(),
            'total' => $pagination->total(),
            'from' => $pagination->firstItem(),
            'to' => $pagination->lastItem(),
            'columns' => $columns,
            'rows' => $rows,
        ]);
    }

    /**
     * Отправить код для подтверждения заявки
     *
     * @return JsonResponse
     */
    public function sendVerificationCode(): JsonResponse
    {
        \Auth::user()->notify(new ConfirmCoinOrder);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Создать заявку на поулчение монеты
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function createCoinOrder(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'full_name' => 'required|string|min:2',
            'phone' => 'required|string|min:6',
            'address' => 'required|string|min:2',
            'coin_amount' => 'required|integer|min:1',
            'verification_code' => 'required|integer|min:10000|max:99999',
        ]);

        /** @var User $authUser */
        $authUser = $request->user();

        if ((int)$requestData['verification_code'] !== $authUser->getVerificationCode('coin_order_creation')) {
            return response()->json(__('Verification code is invalid'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($authUser->balance_coin < $requestData['coin_amount']) {
            logger()->info('Произошла попытка создания заявки на заказ монет с выбранным количеством больше, чем у пользователя на балансе (ID пользователя - ' . \Auth::id() . ')');

            return response()->json(__('Insufficient funds'), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        DB::transaction(function () use ($requestData) {
            $transaction = \Auth::user()->updateBalance(TransactionType::WITHDRAW_RANK_COIN, $requestData['coin_amount']);
            $transaction->apply(Transaction::STATUS_WAIT);

            \Auth::user()
                ->coinOrders()
                ->create($requestData + ['transaction_id' => $transaction->id]);

            \Auth::user()->eraseVerificationCode('coin_order_creation');
        }, 2);

        return response()->json([
            'user_balance_coin' => \Auth::user()->fresh()->balance_coin,
        ], Response::HTTP_CREATED);
    }
}
