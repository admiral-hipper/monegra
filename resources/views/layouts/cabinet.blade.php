@extends('layouts.app')

@section('content-layout')
    @php
        $appLocale = App::getLocale();
    @endphp

    <style>
        .custom-select {
            background: url({{ asset('adminmart/assets/images/custom-select.png') }}) right 1.1rem center no-repeat;
        }
    </style>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
         data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                            class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <div class="navbar-brand">
                        <a href="{{ url('') }}">
                        <span class="logo-text">
                            <img src="{{ asset('ritofos/ritofos-logo-dark-text.svg') }}" alt="homepage" class="dark-logo" width="180px"/>
                        </span>
                        </a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                       data-toggle="collapse" data-target="#navbarSupportedContent"
                       aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                            class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li id="notifications"
                            class="nav-item dropdown"
                            style="display: inline-flex; align-items: center;">
                            <notifications></notifications>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select class="custom-select form-control bg-white custom-radius custom-shadow border-0"
                                            onchange="window.location.href='/locale/' + this.value">
                                        @foreach(config('app.available_locales') as $option)
                                            <option value="{{ $option }}" {{ $appLocale === $option ? ' selected=""' : '' }}>{{ strtoupper($option) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </a>
                        </li>

                        <li class="nav-item d-none d-sm-flex">
                            <a class="nav-link disabled" href="#">
                                {{ \App\Currency::PAIR_RTL_XAU }}
                                <strong>{{ number_format(\App\Currency::getRate(), 8) }}</strong>
                            </a>

                            <a class="nav-link disabled" href="#">
                                {{ \App\Currency::PAIR_RTL_USD }}
                                <strong>{{ number_format(\App\Currency::getRate(\App\Currency::PAIR_RTL_USD), 8) }}</strong>
                            </a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav float-right">
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('ritofos/ritofos-logo-profile.svg') }}"
                                     alt="user"
                                     class="rounded-circle"
                                     width="40"
                                     style="background-color: #fff9db">

                                <span class="ml-2 d-none d-lg-inline-block">
                                    <span>@lang('Hi'),</span>
                                    <span class="text-dark">{{ \Auth::user()->name }}</span>
                                    <i data-feather="chevron-down" class="svg-icon"></i>
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href="{{ route('cabinet.setting') }}">
                                    <i data-feather="settings" class="svg-icon mr-2 ml-1"></i>
                                    @lang('Settings')
                                </a>

                                <a class="dropdown-item" href="{{ route('cabinet.wallet') }}">
                                    <i data-feather="credit-card" class="svg-icon mr-2 ml-1"></i>
                                    @lang('Wallets')
                                </a>

                                <div class="dropdown-divider"></div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i data-feather="log-out" class="svg-icon mr-2 ml-1"></i>
                                    @lang('Log out')
                                </a>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.dashboard') }}" aria-expanded="false">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">@lang('Main')</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">@lang('Token') RTL</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" data-time="{{ date('Y-m-d H:i:s') }}" href="{{ auth()->user()->id <= 4 || time() >= strtotime('2020-09-08 12:00:00') ? route('cabinet.purchase') : '#' }}" aria-expanded="false">
                                <i class="icon-login"></i>
                                <span class="hide-menu">@lang('Purchase')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.withdraw') }}" aria-expanded="false">
                                <i class="icon-logout"></i>
                                <span class="hide-menu">@lang('Sale')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.transaction') }}" aria-expanded="false">
                                <i class="icon-clock"></i>
                                <span class="hide-menu">@lang('Transactions')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.balance') }}" aria-expanded="false">
                                <i class="icon-refresh"></i>
                                <span class="hide-menu">@lang('Translations')</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">@lang('Affiliate program')</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.partnership_program.linear') }}" aria-expanded="false">
                                <i class="icon-people"></i>
                                <span class="hide-menu">@lang('Linear')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.partnership_program.ranked') }}" aria-expanded="false">
                                <i class="icon-trophy"></i>
                                <span class="hide-menu">@lang('Ranked')</span>
                            </a>
                        </li>
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">@lang('Profile')</span></li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.stat') }}" aria-expanded="false">
                                <i class="icon-badge"></i>
                                <span class="hide-menu">@lang('Statistics')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.exchange_rate') }}" aria-expanded="false">
                                <i class="icon-graph"></i>
                                <span class="hide-menu">@lang('Exchange Rates')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.wallet') }}" aria-expanded="false">
                                <i class="icon-wallet"></i>
                                <span class="hide-menu">@lang('Wallets')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{ route('cabinet.setting') }}" aria-expanded="false">
                                <i class="icon-settings"></i>
                                <span class="hide-menu">@lang('Settings')</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" aria-expanded="false">
                                <i data-feather="log-out" class="feather-icon"></i>
                                <span class="hide-menu">@lang('Log out')</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('cabinet.dashboard') }}">@lang('Personal Area')</a>
                                    </li>
                                    @yield('breadcrumbs')
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                @if(Session::has('notify.success'))
                    <div class="alert alert-success">
                        {{ Session::get('notify.success') }}
                    </div>
                @endif

                @if(Session::has('notify.error'))
                    <div class="alert alert-danger">
                        {{ Session::get('notify.error') }}
                    </div>
                @endif

                @yield('content')
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
@endsection
