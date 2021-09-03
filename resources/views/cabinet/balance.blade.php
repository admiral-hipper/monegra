@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Exchange')</li>
@endsection

@section('content')
    <div id="balance-panel">
        <balance-panel :user-balance-state="{{ json_encode($userBalanceState) }}"
                       :user-deposit-balance-state="{{ json_encode($userDepositBalanceState) }}"
                       :can-user-withdraw-deposit="{{ json_encode($canUserWithdrawDeposit) }}"
                       :max-deposit-withdraw-amount="{{ json_encode($maxDepositWithdrawAmount) }}"></balance-panel>
    </div>
@endsection
