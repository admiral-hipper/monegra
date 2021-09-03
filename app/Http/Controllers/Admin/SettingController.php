<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SettingRequest;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Открыть страницу
     *
     * @return View
     */
    public function getView(): View
    {
        $data = [
            'defaults' => Setting::$defaults,
            'accrual_percent_range' => Setting::getAccrualPercentRange(true),
            'last_accrual_percent' => Setting::getLastUsedAccrualPercent(),
            'update_setting_url' => route('admin.setting.update'),
        ];

        return view('vendor.backpack.settings', compact('data'));
    }

    /**
     * Обновить настройку
     *
     * @param SettingRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSetting(SettingRequest $request)
    {
        switch ($request->post('setting_name')) {
            case 'accrual_percent_range':
                Setting::setAccrualPercentRange((float)$request->post('from'), (float)$request->post('to'));
                break;
            default:
                throw new \UnexpectedValueException('Invalid setting name');
        }

        \Alert::success(__('Setting changed successfully'))->flash();

        return redirect()->back();
    }
}
