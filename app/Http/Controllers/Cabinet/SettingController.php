<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\{Request, RedirectResponse};

class SettingController extends Controller
{
    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        $user = \Auth::user();

        return view('cabinet.setting', [
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'phone' => $user->phone,
        ]);
    }

    /**
     * Обновить данные
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Request $request): RedirectResponse
    {
        $user = \Auth::user();

        $requestData = $request->validate([
            'name' => 'required|string|min:2|max:128',
            'surname' => 'required|string|min:2|max:128',
            'email' => 'required|email|max:128|unique:users,email,' . $user->id,
            'phone' => 'required|string|min:10|max:128',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if (!$requestData['password']) {
            unset($requestData['password']);
        } else {
            $requestData['password'] = Hash::make($requestData['password']);
        }

        $user->update($requestData);

        return redirect()->back()->with([
            'name' => $user->name,
            'surname' => $user->surname,
            'email' => $user->email,
            'phone' => $user->phone,
            'status' => __('Data updated successfully'),
        ]);
    }
}
