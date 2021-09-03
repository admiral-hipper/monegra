<?php

namespace App\Http\Controllers\Admin;

use App\{CoinOrder, Transaction};
use Illuminate\Support\Facades\DB;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Prologue\Alerts\Facades\Alert;
use Illuminate\Database\Eloquent\Builder;

class CoinOrderCrudController extends CrudController
{
    use ListOperation;

    /**
     * Основная настройка
     *
     * @throws \Exception
     */
    public function setup()
    {
        CoinOrder::addGlobalScope('relations', function (Builder $query) {
            $query->with(['user:id,name,email', 'transaction:id,type_id,status']);
        });

        $this->crud->setModel(CoinOrder::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/coin-order');
        $this->crud->setEntityNameStrings(trans('admin.coin_order'), trans('admin.coin_orders'));
        $this->crud->enableExportButtons();
    }

    /**
     * Настройка отображения списка
     */
    protected function setupListOperation()
    {
        $optionsForStatusColumnAndFilter = [
            'wait' => trans('admin.transaction_statuses.wait'),
            'success' => trans('admin.transaction_statuses.success'),
            'error' => trans('admin.transaction_statuses.error'),
            'cancel' => trans('admin.transaction_statuses.cancel'),
        ];

        $this->crud->setColumns([
            [
                'label' => 'ID',
                'type' => 'text',
                'name' => 'id',
            ],
            [
                'label' => trans('admin.user'),
                'type' => 'closure',
                'name' => 'user_id',
                'function' => function ($order) {
                    return "<a href='" . route('/user.index', ['id' => $order->user_id]) . "'>{$order->user->email}</a>";
                },
            ],
            [
                'label' => trans('admin.full_name'),
                'type' => 'text',
                'name' => 'full_name',
                'limit' => 99999999999,
            ],
            [
                'label' => trans('admin.phone'),
                'type' => 'text',
                'name' => 'phone',
            ],
            [
                'label' => trans('admin.address'),
                'type' => 'text',
                'name' => 'address',
                'limit' => 99999999999,
            ],
            [
                'label' => trans('admin.amount'),
                'type' => 'text',
                'name' => 'coin_amount',
            ],
            [
                'label' => trans('admin.status'),
                'name' => 'transaction.status',
                'type' => 'select_from_array',
                'options' => $optionsForStatusColumnAndFilter,
            ],
        ]);

        $this->crud->addFilter([
            'name' => 'id',
            'label' => 'ID',
            'type' => 'text',
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
            $this->crud->addClause('whereHas', 'transaction', function ($query) use ($value) {
                $query->where('status', $value);
            });
        });

        $this->crud->addButtonFromModelFunction(
            'line',
            'action_buttons',
            'getActionButtonsForAdminForm'
        );
    }
}
