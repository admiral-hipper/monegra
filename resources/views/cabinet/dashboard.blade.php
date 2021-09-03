@extends('layouts.cabinet')

@php
    $pairName = \App\Currency::getPairName('RTL', 'USD');
    $depositAmountInUSD = \App\Currency::getRate($pairName, \Auth::user()->balance_token_deposit);
@endphp

@section('content')
    <div class="mb-3">
        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">@lang('Hi'), {{ \Auth::user()->name }}!</h3>
        @if ($referral)
            <span>@lang('Referred by') {{ $referral->getFullName() }}, {{ $referral->email }}</span>
        @endif
    </div>

    <div id="copy-ref-link">
        <copy-ref-link :referral-link="{{ json_encode(\Auth::user()->referral_link) }}"></copy-ref-link>
    </div>

    <div class="row">
        <div class="col col-md-6 mb-5 offset-md-3 text-center">
            <a href="{{ route('cabinet.purchase') }}" class="btn btn-block btn-primary">@lang('Purchase') RTL</a>
            <a href="{{ route('cabinet.withdraw') }}" class="btn btn-block btn-primary">@lang('Sale') RTL</a>
        </div>
    </div>

    <!-- *************************************************************** -->
    <!-- Start First Cards -->
    <!-- *************************************************************** -->
    <div class="col-12">
        <div class="card-group row overflow-hidden">
            <div class="col p-0 m-0">
                <div class="card m-0 border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ \Auth::user()->referralsCount(true) }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Referrals attracted')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-0 m-0">
                <div class="card m-0 border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    {{ number_format(\Auth::user()->balance_token, 2) }}
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                    @lang('Settlement balance')
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><strong>RTL</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-0 m-0">
                <div class="card m-0 border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    {{ number_format(\Auth::user()->balance_token_deposit, 2) }} <small style="margin-right: 5px; color: #bababa;">= ${{ number_format($depositAmountInUSD, 2) }}</small>
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                    @lang('Deposit balance')
                                </h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><strong>RTL</strong></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-0 m-0">
                <div class="card m-0 border-right">
                    <div class="card-body">
                        <div class="d-flex d-lg-flex d-md-block align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ Auth::user()->balance_coin }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">@lang('Gold coins')</h6>
                            </div>
                            <div class="ml-auto mt-md-3 mt-lg-0">
                        <span class="opacity-7 text-muted">
                            <strong>RGP</strong>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End First Cards -->
    <!-- *************************************************************** -->
    <!-- *************************************************************** -->
    <!-- Start Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start">
                        <h4 class="card-title mb-0">@lang('Course') {{ \App\Currency::PAIR_RTL_XAU }}</h4>
                    </div>
                    <div class="pl-4 mb-5">
                        <div id="js-rate-rsh"></div>
                    </div>
                    <ul class="list-inline text-center mt-4 mb-0">
                        <li class="list-inline-item text-muted font-italic">@lang('Course statistics for month')</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- *************************************************************** -->
    <!-- End Location and Earnings Charts Section -->
    <!-- *************************************************************** -->
@endsection

@section('scripts')

    <script>
        $(function () {
            var data = <?= json_encode(\App\RateHistory::getHistoryByPeriod(\App\RateHistory::PERIOD_DAY));?>


            var line = new Morris.Line({
                element: 'js-rate-rsh',
                resize: true,
                data: data,
                xkey: 'date',
                ykeys: ['rate'],
                labels: ['RTL/XAU'],
                gridLineColor: '#eef0f2',
                lineColors: ['#5f76e8'],
                lineWidth: 2,
                hideHover: 'auto'
            });
        });
    </script>
@endsection
