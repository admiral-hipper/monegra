@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Affiliate program')</li>
    <li class="breadcrumb-item active">{{ $programName === 'linear' ? __('Linear') : __('Ranked')}}</li>
@endsection

@section('content')
    @if($programName === 'linear')
        <div id="linear-partnership-program">
            <linear-partnership-program :referral-link="{{ json_encode($referralLink) }}"></linear-partnership-program>
        </div>
    @else
        <div id="ranked-partnership-program">
            <ranked-partnership-program :user-balance-coin="{{ $userBalanceCoin }}"
                                        :user-balance-coin-total="{{ $userBalanceCoinTotal }}"
                                        :user-rank="{{ $userRank }}"
                                        :rank-conditions="{{ json_encode($rankConditions) }}"></ranked-partnership-program>
        </div>
    @endif
@endsection
