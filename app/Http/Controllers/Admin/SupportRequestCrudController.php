<?php

namespace App\Http\Controllers\Admin;

use App\SupportRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\{ListOperation, DeleteOperation};

class SupportRequestCrudController extends CrudController
{
    use ListOperation,
        DeleteOperation;

    /**
     * Основная настройка
     *
     * @throws \Exception
     */
    public function setup()
    {
        $this->crud->setModel(SupportRequest::class);
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/support-request');
        $this->crud->setEntityNameStrings(trans('admin.support_request'), trans('admin.support_requests'));
        $this->crud->enableExportButtons();
    }

    /**
     * Настройка отображения списка
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
                'label' => trans('admin.name'),
                'type' => 'text',
                'name' => 'name',
            ],
            [
                'label' => trans('admin.message'),
                'type' => 'text',
                'name' => 'message',
                'limit' => 99999999999,
            ],
            [
                'label' => trans('admin.created_at'),
                'type' => 'text',
                'name' => 'created_at',
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
            'name' => 'email',
            'label' => trans('admin.email'),
            'type' => 'text',
        ],
            false,
            function ($value) {
                $this->crud->addClause('where', 'email', 'LIKE', "%$value%");
            });
    }
}
