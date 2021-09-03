@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Profile')</li>
    <li class="breadcrumb-item active">@lang('Wallets')</li>
@endsection

@section('content')
    <div id="wallets-panel">
        <wallets-panel></wallets-panel>
    </div>
@endsection
