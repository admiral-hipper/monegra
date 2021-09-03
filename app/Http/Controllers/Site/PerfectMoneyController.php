<?php

namespace App\Http\Controllers\Site;

use App\Transaction;
use App\Services\Payments\PerfectMoney;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PerfectMoneyController extends Controller
{
    public function success(Request $request)
    {
        \Session::flash('notify.success', __('Thank you, your payment was successfully processed.'));

        return redirect(route('cabinet.transaction'));
    }

    public function fail()
    {
        try {
            \Session::flash('notify.error', __('Your payment has not been processed, please contact support.'));

            $perfectMoney = new PerfectMoney();
            $transaction = Transaction::find($perfectMoney->getOrderId());

            if ($transaction !== null) {
                $transaction->apply(Transaction::STATUS_ERROR);
                $transaction->createContext(json_encode($perfectMoney->getRequestData()));
            }
        } catch (\Throwable $e) {
            \Session::flash('notify.error', sprintf(
                __('Your payment has not been processed, please contact support (% s).'),
                $e->getMessage()
            ));
        }

        return redirect(route('cabinet.transaction'));
    }

    public function status()
    {
        \Log::info($_REQUEST);

        $perfectMoney = new PerfectMoney();
        $requestData = $perfectMoney->processRequest();
        $transaction = Transaction::find($perfectMoney->getOrderId());

        if ($transaction !== null) {
            $transaction->apply();
            $transaction->createContext(json_encode($requestData));
        }
    }
}
