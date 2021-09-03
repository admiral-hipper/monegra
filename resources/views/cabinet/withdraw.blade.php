@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Token') RTL</li>
    <li class="breadcrumb-item active">@lang('Sale')</li>
@endsection

@section('content')
    <div id="withdraw-panel">
        <withdraw-panel :user-balance-state="{{ json_encode($userBalanceState) }}"
                        :ratesell="{{ json_encode(number_format($rateSell, 8)) }}"
                        :ratesellusd="{{ json_encode(number_format($rateSellUsd, 8)) }}"
                        :user-wallets="{{ json_encode($userWallets) }}"
                        :link-to-wallets="{{ json_encode($linkToWallets) }}"
                        :quotes="{{ json_encode($quotes) }}"></withdraw-panel>
    </div>
@endsection
