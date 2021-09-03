<?php

namespace App\Http\Requests\Admin;

use App\Setting;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingRequest extends FormRequest
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
        return [
            'setting_name' => 'required|string|in:accrual_percent_range',
            'from' => [
                'required',
                'numeric',
                'min:' . Setting::$defaults['accrual_percent_range'][0],
                'max:' . request('to'),
                Rule::requiredIf(request('setting_name') === 'accrual_percent_range'),
            ],
            'to' => [
                'required',
                'numeric',
                'min:' . request('from'),
                'max:' . Setting::$defaults['accrual_percent_range'][1],
                Rule::requiredIf(request('setting_name') === 'accrual_percent_range'),
            ],
        ];
    }

    /** @inheritDoc */
    public function attributes()
    {
        return [
            'setting_name' => __('Setting name'),
            'from' => __('From'),
            'to' => __('To'),
        ];
    }
}
