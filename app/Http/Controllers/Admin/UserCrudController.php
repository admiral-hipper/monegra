<?php

namespace App\Http\Controllers\Admin;

use App\{User, Transaction, TransactionType, Currency};
use App\Http\Requests\Admin\UserCrudRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\{ListOperation, CreateOperation, UpdateOperation, DeleteOperation};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Prologue\Alerts\Facades\Alert;

class UserCrudController extends CrudController
{
    use ListOperation,
        DeleteOperation;

    use CreateOperation {
        store as storeMethodFromCreateOperation;
    }
    use UpdateOperation {
        update as updateMethodFromCreateOperation;
    }

    /**
     * Основная настройка
     *
     * @throws \Exception
     */
    public function setup()
    {
        User::addGlobalScope('relations', function (Builder $query) {
            $query->with('referralParent:id,email');
        });

        $this->crud->setModel(User::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/user');
        $this->crud->setEntityNameStrings(trans('admin.user'), trans('admin.users'));
        $this->crud->enableExportButtons();
    }

    /**
     * Пополнить баланс пользователя
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function replenishment(Request $request)
    {
        $userId = $request->input('user_id');
        $amount = (float)$request->input('amount');

        if (!$userId || !$user = User::find($userId)) {
            Alert::error("Пользователь с id - {$userId} не найден")->flash();

            return redirect()->back();
        }

        if (!$amount) {
            Alert::error('Некорректная сумма')->flash();
            Alert::info('Баланс не был изменен')->flash();

            return redirect()->back();
        }

        \DB::transaction(function () use ($user, $amount) {
            $typeId = TransactionType::DEPOSIT_ADMIN;
            $transaction = $user->updateBalance($typeId, $amount);
            $transaction->apply(Transaction::STATUS_SUCCESS);

            $internalCurrencyCode = Currency::find(Currency::RTL)->code;

            $transaction->user->sendNotification(__(
                'messages.balance_replenished',
                [
                    'amount' => $transaction->balance_token_amount,
                    'balance_token' => $transaction->user->balance_token,
                    'currency_code' => $internalCurrencyCode,
                ],
                $transaction->user->locale
            ));
        });

        Alert::success("{$userId} - Баланс пользователя успешно изменен")->flash();

        return redirect()->back();
    }

    /**
     * Настройка отображения списка пользователей
     */
    protected function setupListOperation()
    {
        $this->crud->setColumns([
            [
                'label' => 'ID',
                'type' => 'text',
                'name' => 'id',
            ],
            [
                'label' => trans('admin.email'),
                'type' => 'email',
                'name' => 'email',
            ],
            [
                'label' => trans('admin.referral_parent'),
                'type' => 'email',
                'name' => 'referralParent.email',
            ],
            [
                'label' => trans('admin.admin'),
                'type' => 'check',
                'name' => 'is_admin',
            ],
            [
                'label' => trans('admin.name'),
                'type' => 'text',
                'name' => 'name',
            ],
            [
                'label' => trans('admin.surname'),
                'type' => 'text',
                'name' => 'surname',
            ],
            [
                'label' => trans('admin.balance'),
                'type' => 'text',
                'name' => 'balance_token',
            ],
            [
                'label' => trans('admin.balance_deposit'),
                'type' => 'text',
                'name' => 'balance_token_deposit',
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
            'name' => 'name',
            'label' => trans('admin.name'),
            'type' => 'text',
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'name', 'LIKE', "%$value%");
            });

        $this->crud->addFilter([
            'name' => 'email',
            'label' => trans('admin.email'),
            'type' => 'text',
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'email', 'LIKE', "%$value%");
            });

        $this->crud->addButtonFromView('line', 'balance_button', 'user_balance');

        $this->crud->addButtonFromModelFunction('line', 'action_buttons', 'getActionButtonsForAdminForm');
    }

    /**
     * Настройка формы создания пользователя
     */
    protected function setupCreateOperation()
    {
        $this->crud->setValidation(UserCrudRequest::class);

        $this->crud->addFields([
            [
                'name' => 'is_admin',
                'label' => trans('admin.admin'),
                'type' => 'checkbox',
                'default' => false,
            ],
            [
                'name' => 'name',
                'label' => trans('admin.name'),
                'type' => 'text',
            ],
            [
                'name' => 'surname',
                'label' => trans('admin.surname'),
                'type' => 'text',
            ],
            [
                'name' => 'email',
                'label' => trans('admin.email'),
                'type' => 'email',
            ],
            [
                'name' => 'password',
                'label' => trans('admin.password'),
                'type' => 'password',
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
            [
                'name' => 'password_confirmation',
                'label' => trans('admin.password_confirmation'),
                'type' => 'password',
                'attributes' => [
                    'autocomplete' => 'off',
                ],
            ],
        ]);
    }

    /**
     * Настройка формы редактирования пользователя
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    /**
     * Авторизоваться под пользоватлем
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAsUser(User $user)
    {
        \Auth::logout();

        \Auth::loginUsingId($user->id);

        return redirect()->route('cabinet.dashboard');
    }

    /**
     * Метод вызываемый при создании нового пользователя
     *
     * @param UserCrudRequest $request
     * @return mixed
     */
    public function store(UserCrudRequest $request)
    {
        $this->handlePasswordInput($request);

        return $this->storeMethodFromCreateOperation();
    }

    /**
     * Метод вызываемый при обновлении существующего пользоватея
     *
     * @param UserCrudRequest $request
     * @return mixed
     */
    public function update(UserCrudRequest $request)
    {
        $this->handlePasswordInput($request);

        return $this->updateMethodFromCreateOperation();
    }

    /**
     * Удаление поля подтверждения пароля и хеширование поля пароля перед сохранением
     *
     * @param Request $request
     * @return void
     */
    private function handlePasswordInput(Request $request)
    {
        if ($request->exists('password_confirmation')) {
            $request->replace($request->except(['password_confirmation']));
        }

        if ($request->filled('password')) {
            $request->merge(['password' => Hash::make($request->input('password'))]);
        } else {
            $request->replace($request->except(['password']));
        }

        $this->crud->setRequest($request);
    }
}
