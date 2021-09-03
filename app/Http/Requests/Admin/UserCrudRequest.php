<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCrudRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return backpack_auth()->check() && backpack_user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $actionMethod = request()->route()->getActionMethod();

        return [
            'name' => 'required|string|min:2',
            'surname' => 'required|string|min:2',
            'email' => 'required|unique:users,email,' . $this->get('id'),
            'password' => [
                $actionMethod === 'store' ? 'required' : 'nullable',
                'min:6',
            ],
            'password_confirmation' => 'same:password',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => '"' . trans('admin.name') . '"',
            'email' => '"' . trans('admin.email') . '"',
            'password' => '"' . trans('admin.password') . '"',
            'password_confirmation' => '"' . trans('admin.password_confirmation') . '"',
        ];
    }
}
