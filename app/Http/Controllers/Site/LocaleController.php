<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, Session};
use Illuminate\Http\{RedirectResponse, Request};
use Symfony\Component\HttpFoundation\Response;

class LocaleController extends Controller
{
    /**
     * Установить выбранный язык локали
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function setLocale(Request $request): RedirectResponse
    {
        $locale = $request->route()->parameter('locale');

        if (!in_array($locale, config('app.available_locales'), true)) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        Session::put('locale', $locale);

        if (Auth::check()) {
            Auth::user()->update(['locale' => $locale]);
        }

        return redirect()->back();
    }
}
