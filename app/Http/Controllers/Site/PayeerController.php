<?php

namespace App\Http\Controllers\Site;

use App\Transaction;
use App\Services\Payments\Payeer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayeerController extends Controller
{
    public function success(Request $request)
    {
        \Session::flash('notify.success', __('Thank you, your payment was successfully processed.'));

        return redirect(route('cabinet.transaction'));
    }

    public function fail()
    {
        \Session::flash('notify.error', __('Your payment has not been processed, please contact support.'));

        return redirect(route('cabinet.transaction'));
    }

    public function status()
    {
        \Log::info($_REQUEST);

        $payeer = new Payeer();
        $requestData = $payeer->processRequest();
        $transaction = Transaction::find($payeer->getOrderId());

        if ($transaction !== null) {
            if ($payeer->getStatus() === Payeer::STATUS_SUCCESS) {
                $transaction->apply();
            } else {
                $transaction->apply(Transaction::STATUS_ERROR);
            }

            $transaction->createContext(json_encode($requestData));
        }
    }
}
