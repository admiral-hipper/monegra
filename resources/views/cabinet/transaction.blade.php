@extends('layouts.cabinet')

@section('breadcrumbs')
    <li class="breadcrumb-item active">@lang('Transactions')</li>
@endsection

@section('content')
    <div id="transactions-panel">
        <transactions-panel></transactions-panel>
    </div>
@endsection
