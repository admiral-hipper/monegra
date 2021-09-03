@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Token') RTL</li>
    <li class="breadcrumb-item active">@lang('Purchase')</li>
@endsection

@section('content')
    <div id="purchase-panel">
        <purchase-panel :wallet-types="{{ json_encode($walletTypes) }}"
                        :quotes="{{ json_encode($quotes) }}"></purchase-panel>
    </div>
@endsection
