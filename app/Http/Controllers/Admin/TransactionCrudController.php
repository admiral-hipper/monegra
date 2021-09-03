<?php

namespace App\Http\Controllers\Admin;

use App\{Currency, Transaction, TransactionType};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Prologue\Alerts\Facades\Alert;

class TransactionCrudController extends CrudController
{
    use ListOperation;

    /**
     * Основная настройка
     *
     * @throws \Exception
     */
    public function setup()
    {
        Transaction::addGlobalScope('relations', function (Builder $query) {
            $query->with([
                'user:id,name,email',
                'currency:id,name_ru,name_en',
                'type:id,name_ru,name_en',
                'wallets:id,number',
            ])->where('status', '!=', Transaction::STATUS_NEW);
        });

        $this->crud->setModel(Transaction::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/transaction');
        $this->crud->setEntityNameStrings(trans('admin.transaction'), trans('admin.transactions'));
        $this->crud->enableExportButtons();
    }

    /**
     * Настройка отображения списка
     */
    protected function setupListOperation()
    {
        $appLocale = app()->getLocale();

        $optionsForStatusColumnAndFilter = [
            'wait' => trans('admin.transaction_statuses.wait'),
            'success' => trans('admin.transaction_statuses.success'),
            'error' => trans('admin.transaction_statuses.error'),
            'cancel' => trans('admin.transaction_statuses.cancel'),
        ];

        $this->crud->orderBy('id', 'desc');

        $this->crud->setColumns([
            [
                'name' => 'id',
                'label' => 'ID',
                'type' => 'text',
            ],
            [
                'label' => trans('admin.user'),
                'type' => 'closure',
                'name' => 'user_id',
                'function' => function ($model) {
                    return "<a href='" . route('/user.index', ['id' => $model->user_id]) . "'>{$model->user->email}</a>";
                },
            ],
            [
                'name' => 'status',
                'label' => trans('admin.status'),
                'type' => 'select_from_array',
                'options' => $optionsForStatusColumnAndFilter,
            ],
            [
                'name' => 'currency.name_' . $appLocale,
                'label' => trans('admin.currency'),
                'type' => 'text',
            ],
            [
                'name' => 'type.name_' . $appLocale,
                'label' => trans('admin.type'),
                'type' => 'text',
                'limit' => 99999999999,
            ],
            [
                'name' => 'wallet.number',
                'label' => trans('admin.wallet'),
                'type' => 'closure',
                'limit' => 9999999,
                'function' => function ($model) {
                    if (!$model->wallets || !$model->wallets->first()) {
                        return '-';
                    }

                    return $model->wallets->first()->number;
                },
            ],
            [
                'label' => trans('admin.amount'),
                'type' => 'text',
                'name' => 'amount',
            ],
            [
                'label' => trans('admin.token_rate'),
                'type' => 'text',
                'name' => 'rate_token',
            ],
            [
                'label' => trans('admin.comment'),
                'type' => 'text',
                'name' => 'comment',
            ],
            [
                'label' => trans('admin.created_at'),
                'type' => 'text',
                'name' => 'created_at',
            ],
            [
                'label' => trans('admin.updated_at'),
                'type' => 'text',
                'name' => 'updated_at',
            ],
        ]);

        $this->crud->addFilter([
            'name' => 'id',
            'type' => 'text',
            'label' => 'ID'
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'id', $value);
            });

        $this->crud->addFilter([
            'name' => 'status',
            'type' => 'select2',
            'label' => trans('admin.status')
        ], function () use ($optionsForStatusColumnAndFilter) {
            return $optionsForStatusColumnAndFilter;
        }, function ($value) {
            $this->crud->addClause('where', 'status', $value);
        });

        $this->crud->addFilter([
            'name' => 'type_id',
            'type' => 'select2',
            'label' => trans('admin.type')
        ], function () {
            return [
                'replenishment' => trans('admin.replenishment'),
                'withdrawal' => trans('admin.withdrawal'),
                'other' => trans('admin.other'),
            ];
        }, function ($value) {
            if ($value === 'replenishment') {
                $this->crud->addClause('whereIn', 'type_id', [
                    TransactionType::DEPOSIT_PAYEER,
                    TransactionType::DEPOSIT_PM,
                    TransactionType::DEPOSIT_BTC,
                    TransactionType::DEPOSIT_ETH,
                    TransactionType::DEPOSIT_PZM,
                ]);
            } else if ($value === 'withdrawal') {
                $this->crud->addClause('whereIn', 'type_id', [
                    TransactionType::WITHDRAW_PAYEER,
                    TransactionType::WITHDRAW_PM,
                    TransactionType::DEPOSIT_BTC,
                    TransactionType::DEPOSIT_ETH,
                    TransactionType::DEPOSIT_PZM,
                ]);
            } else {
                $this->crud->addClause('whereNotIn', 'type_id', TransactionType::TYPES_FOR_MANUAL_HANDLING);
            }
        });

        $this->crud->addFilter([
            'name' => 'types_for_manual_handling',
            'type' => 'simple',
            'label' => trans('admin.manual_handling')
        ],
            false,
            function () {
                $this->crud->addClause('whereIn', 'type_id', TransactionType::TYPES_FOR_MANUAL_HANDLING);
            });

        $this->crud->addButtonFromModelFunction(
            'line',
            'action_buttons',
            'getActionButtonsForAdminForm'
        );
    }

    /**
     * Подтвердить транзакцию
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function confirmTransaction(Transaction $transaction)
    {
        if (!$transaction->needManualHandling()) {
            Alert::warning($transaction->id . ' - ' . trans('messages.transaction_could_not_be_processed'))->flash();

            return redirect()->back();
        }

        DB::transaction(function () use ($transaction) {
            $internalCurrencyCode = Currency::find(Currency::RTL)->code;
            $transaction->apply();

            if ($transaction->isDepositTransaction()) {
                $transaction->user->sendNotification(__(
                    'messages.balance_replenished',
                    [
                        'amount' => $transaction->balance_token_amount,
                        'balance_token' => $transaction->user->balance_token,
                        'currency_code' => $internalCurrencyCode,
                    ],
                    $transaction->user->locale
                ));
            }

            if ($transaction->isWithdrawTransaction()) {
                if ($transaction->isRankCoinTransaction()) {
                    $transaction->user->sendNotification(__(
                        'messages.request_for_coins_confirmed',
                        [
                            'amount' => abs(intval($transaction->balance_coin_amount)),
                            'balance_coin' => $transaction->user->balance_coin,
                        ],
                        $transaction->user->locale
                    ));
                } else {
                    $transaction->user->sendNotification(__(
                        'messages.withdrawal_transaction_confirmed',
                        [
                            'amount' => abs($transaction->balance_token_amount),
                            'balance_token' => $transaction->user->balance_token,
                            'currency_code' => $internalCurrencyCode,
                        ],
                        $transaction->user->locale
                    ));
                }
            }
        });

        Alert::success($transaction->id . ' - ' . trans('messages.transaction_status_changed_successfully'))->flash();

        return redirect()->back();
    }

    /**
     * Отменить транзакцию
     *
     * @param Transaction $transaction
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function cancelTransaction(Transaction $transaction)
    {
        if (!$transaction->needManualHandling()) {
            Alert::warning($transaction->id . ' - ' . trans('messages.transaction_could_not_be_processed'))->flash();

            return redirect()->back();
        }

        DB::transaction(function () use ($transaction) {
            $internalCurrencyCode = Currency::find(Currency::RTL)->code;
            $transaction->apply(Transaction::STATUS_CANCEL);

            if ($transaction->isDepositTransaction()) {
                $transaction->user->sendNotification(__(
                    'messages.replenishment_transaction_failed',
                    [
                        'amount' => $transaction->balance_token_amount,
                        'balance_token' => $transaction->user->balance_token,
                        'currency_code' => $internalCurrencyCode,
                    ],
                    $transaction->user->locale
                ));
            }

            if ($transaction->isWithdrawTransaction()) {
                if ($transaction->isRankCoinTransaction()) {
                    $transaction->user->sendNotification(__(
                        'messages.request_for_coins_has_been_canceled',
                        [
                            'amount' => abs(intval($transaction->balance_coin_amount)),
                            'balance_coin' => $transaction->user->balance_coin,
                        ],
                        $transaction->user->locale
                    ));
                } else {
                    $transaction->user->sendNotification(__(
                        'messages.withdrawal_transaction_declined',
                        [
                            'amount' => abs($transaction->balance_token_amount),
                            'balance_token' => $transaction->user->balance_token,
                            'currency_code' => $internalCurrencyCode,
                        ],
                        $transaction->user->locale
                    ));
                }
            }
        });

        Alert::success($transaction->id . ' - ' . trans('messages.transaction_status_changed_successfully'))->flash();

        return redirect()->back();
    }
}
