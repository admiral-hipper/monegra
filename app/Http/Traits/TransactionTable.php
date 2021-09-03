<?php

namespace App\Http\Traits;

use App\Transaction;
use Illuminate\Http\{Request, JsonResponse};
use Illuminate\Pagination\Paginator;

trait TransactionTable
{
    /**
     * Получить транзации для таблицы
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTransactions(Request $request): JsonResponse
    {
        /**
         * @var $pagination Paginator
         */
        $pagination = \Auth::user()
            ->transactions()
            ->when($this->transactionTypeIdsForTable ?? null, function ($query, $transactionTypes) {
                $query->whereIn('type_id', $transactionTypes);
            })
            ->with('type', 'currency')
            ->orderByDesc('updated_at')
            ->paginate($request->input('per_page') ?? 10);

        $currentPage = $pagination->currentPage();
        $nextPage = $pagination->hasMorePages() ? $currentPage + 1 : null;
        $items = $pagination->items();

        $columns = [
            __('Type'),
            __('Amount') . ', RTL',
            __('Status'),
            __('Changed'),
        ];

        $appLocale = \App::getLocale();

        $rows = [];

        /** @var Transaction[] $items */
        foreach ($items as $item) {
            $valueType = sprintf(
                '<strong>%s</strong><br>%s%s',
                $item->type->{'name_' . $appLocale},
                $item->amount,
                ' ' . $item->currency->{'name_' . $appLocale}
            );

            // если курс нулевой, то он не выводится,
            // так как транзакция скорей всего связана
            // с манипуляцией токена или золотой монеты
            if ((float)$item->rate_token) {
                $valueType .= sprintf('<br>RTL/XAU %s', $item->rate_token);
            }

            if ((float)$item->balance_token_amount !== 0.00) {
                $valueAmount = $item->balance_token_amount;
            } else if ((float)$item->balance_token_deposit_amount !== 0.00) {
                $valueAmount = $item->balance_token_deposit_amount;
            } else if ((float)$item->balance_coin_amount !== 0.00) {
                $valueAmount = $item->balance_coin_amount;
            } else {
                $valueAmount = '-';
            }

            $rows[] = [
                ['id' => $item->id, 'hidden' => true],
                ['value' => $valueType],
                ['value' => $valueAmount],
                ['value' => trans('cabinet.transaction_statuses.' . $item->status)],
                ['value' => $item->updated_at ? $item->updated_at->format('d.m.Y H:i') : '-'],
            ];
        }

        return response()->json([
            'pagination' => $pagination,
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
}
