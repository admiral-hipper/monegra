<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        return view('cabinet.dashboard', [
            'referral' => \Auth::user()->parent()->first(),
        ]);
    }
}
