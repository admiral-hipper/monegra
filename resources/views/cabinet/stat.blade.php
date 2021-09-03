@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Statistics')</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">@lang('Statistics')</h4>
                    <p class="card-text">@lang('Achievement statistics')</p>

                    <div class="table-responsive">
                        <table class="table">
                        <tr>
                            <td colspan="2"><strong>Ritofos Talant</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('In stock'):</td>
                            <td>{{ $stat['totalRtl'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('In stock (settlement balance)'):</td>
                            <td>{{ $stat['totalGeneralRtl'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('In stock (deposit balance)'):</td>
                            <td>{{ $stat['totalDepositRtl'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('Purchased'):</td>
                            <td>{{ $stat['totalRtlBuy'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('Sold'):</td>
                            <td>{{ $stat['totalRtlSell'] }} RTL</td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>@lang('Deposit achievements')</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('Received dividends'):</td>
                            <td>{{ $stat['totalRtlAccrual'] }} RTL</td>
                        </tr>
                        {{--
                        <tr>
                            <td>@lang('Received dividends'):</td>
                            <td>{{ $stat['totalUsdAccrual'] }} USD</td>
                        </tr>
                        --}}
                        <tr>
                            <td colspan="2"><strong>@lang('Affiliate program')</strong></td>
                        </tr>
                        <tr>
                            <td>@lang('Partners in total'):</td>
                            <td>{{ $stat['myReferralsCountTotal'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('1st line partners'):</td>
                            <td>{{ $stat['myReferralsCount'] }}</td>
                        </tr>
                        <tr>
                            <td>@lang('1st line partners turnover'):</td>
                            <td>{{ $stat['myReferralsDeposit'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('Received gold coins by 1st line partners'):</td>
                            <td>{{ $stat['myReferralsCoinCount'] }} RGP</td>
                        </tr>
                        <tr>
                            <td>@lang('The amount of the settlement balance of partners of the 1st line'):</td>
                            <td>{{ $stat['myReferralsBalanceToken'] }} RTL</td>
                        </tr>
                        <tr>
                            <td>@lang('The amount of the deposit balance of partners of the 1st line'):</td>
                            <td>{{ $stat['myReferralsBalanceTokenDeposit'] }} RTL</td>
                        </tr>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
