<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Traits\TransactionTable;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class TransactionController extends Controller
{
    use TransactionTable;

    /**
     * Открыть страницу
     *
     * @return View
     */
    public function index(): View
    {
        return view('cabinet.transaction');
    }
}
