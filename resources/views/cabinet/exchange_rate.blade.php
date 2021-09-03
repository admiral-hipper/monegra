@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Exchange Rates')</li>
@endsection

@section('content')
    <div id="exchange-rates">
        <exchange-rates :exchange-rates="{{ json_encode($exchangeRates) }}"></exchange-rates>
    </div>
@endsection
