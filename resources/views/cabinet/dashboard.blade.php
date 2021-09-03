@extends('layouts.app')

@php
    $pairName = \App\Currency::getPairName('RTL', 'USD');
    $depositAmountInUSD = \App\Currency::getRate($pairName, \Auth::user()->balance_token_deposit);
@endphp

@section('content-layout')

<!-- TEST

TEST -->


<div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="ti-menu ti-close"></i>
                    </a>
                    <div class="navbar-brand">
                        <a href="{{route('site')}}">
                            <b class="logo-icon">
                                <img src="assets/images/logo-icon.svg" alt="homepage" class="" />
                            </b>
                            <span class="logo-text">
                                <img src="assets/images/logo-text.svg" alt="homepage" class="" />
                            </span>
                        </a>
                    </div>
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                        data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti-more"></i>
                    </a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left mr-auto ml-3 pl-1">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle pl-md-3 position-relative" href="javascript:void(0)"
                                id="bell" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <span><i data-feather="bell" class="svg-icon"></i></span>
                                <span class="badge badge-orange text-white notify-no rounded-circle">5</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left mailbox animated bounceInDown">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="message-center notifications position-relative">
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <div class="btn btn-warning text-white rounded-circle btn-circle">
                                                    <i data-feather="airplay" class="text-white"></i>
                                                </div>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Обзор личного кабинета</h6>
                                                    <span class="font-12 text-nowrap d-block text-muted">Просто посмотри!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-warning text-white text-white rounded-circle btn-circle"><i
                                                        data-feather="calendar" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Event today</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">Just
                                                        a reminder that you have event</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-warning text-white rounded-circle btn-circle"><i
                                                        data-feather="settings" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Settings</h6>
                                                    <span
                                                        class="font-12 text-nowrap d-block text-muted text-truncate">You
                                                        can customize this template
                                                        as you want</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span>
                                                </div>
                                            </a>
                                            <a href="javascript:void(0)"
                                                class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-warning text-white rounded-circle btn-circle"><i
                                                        data-feather="box" class="text-white"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h6 class="message-title mb-0 mt-1">Pavan kumar</h6> <span
                                                        class="font-12 text-nowrap d-block text-muted">Just
                                                        see the my admin!</span>
                                                    <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link pt-3 text-center text-dark" href="javascript:void(0);">
                                            <strong>Посмотреть все оповещения</strong>
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- <li class="nav-item  d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <div class="customize-input">
                                    <select
                                        class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                        <option selected>RU</option>
                                        <option value="1">EN</option>
                                        <option value="2">DE</option>
                                        <option value="3">IT</option>
                                    </select>
                                </div>
                            </a>
                        </li> -->
                    </ul>
                    <ul class="navbar-nav float-right">
                        <!-- <li class="nav-item d-none d-md-block">
                            <a class="nav-link text-dark font-weight-bold" href="javascript:void(0)" data-toggle="tooltip" title="Финансовый баланс">
                                <p>$12312</p>
                            </a>
                        </li>
                        <li class="nav-item d-none d-md-block">
                            <a class="nav-link text-dark font-weight-bold" href="javascript:void(0)" data-toggle="tooltip" title="Операционный баланс">
                                <p>$412124</p>
                            </a>
                        </li> -->
                        <li class="nav-item d-md-block">
                            <a class="nav-link" href="javascript:void(0)">
                                <form class="d-flex">
                                    <div class="customize-input" data-toggle="tooltip" title="Реферальная ссылка. Скопируйте и отправьте тому, кого хотите пригласить.">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white text-dark"
                                        value="{{ Auth::user()->referral_link }}" aria-label="reflink" disabled="">
                                           
                                        <i class="form-control-icon icon-docs"></i>
                                    </div>
                                </form>
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <img src="assets/images/users/profile-pic.jpg" alt="user" class="rounded-circle"
                                    width="40">
                                <span class="ml-2 d-none d-lg-inline-block"><span></span> <span
                                        class="text-dark">Владислав Громов</span> <i data-feather="chevron-down"
                                        class="svg-icon"></i></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                                <a class="dropdown-item" href=""><i data-feather="settings"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Настройки</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i data-feather="power"
                                        class="svg-icon mr-2 ml-1"></i>
                                    Выйти</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <div class="scroll-sidebar" data-sidebarbg="skin6">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item">
                            <a class="sidebar-link sidebar-link" href="" aria-expanded="false">
                                <i data-feather="home" class="feather-icon"></i>
                                <span class="hide-menu">Главная</span>
                            </a>
                        </li>
                        
                        <li class="list-divider"></li>
                        <li class="nav-small-cap"><span class="hide-menu">Дополнительно</span></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="app-calendar.html"
                                aria-expanded="false"><i data-feather="calendar" class="feather-icon"></i><span
                                    class="hide-menu">Все оповещения</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="../../docs/docs.html"
                                aria-expanded="false"><i data-feather="edit-3" class="feather-icon"></i><span
                                    class="hide-menu">Инструкции</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="authentication-login1.html"
                                aria-expanded="false"><i data-feather="log-out" class="feather-icon"></i><span
                                    class="hide-menu">Выйти</span></a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 mb-2 mt-2">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mr-2">Добро пожаловать, Владислав Громов</h3>
                    </div>
                    <div class="col-11 align-self-center">
                        <button type="button" class="btn btn-warning text-dark font-weight-bold mr-2 mt-1" data-toggle="modal" data-target="#myModal">Операционный баланс: {{ number_format(\Auth::user()->balance_token, 2) }}</button>
                        <button type="button" class="btn btn-warning text-dark font-weight-bold mr-2 mt-1" data-toggle="modal" data-target="#myModal">Финансовый баланс: {{ number_format(\Auth::user()->balance_token_deposit, 2)}}</button>
                    </div>
                    <div class="dropdown col-1">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i data-feather="settings" class="svg-icon"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Вся статистика</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Инвестиционная программа</a>
                            <a class="dropdown-item" href="#">Партнёрская программа</a>
                            <a class="dropdown-item" href="#">Продажи услуг</a>
                        </div>
                    </div>
                    <!-- <div class="col-12 col-lg-3 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected>Вся статистика</option>
                                <option value="1">Инвестиционная программа</option>
                                <option value="2">Парнёрская программа</option>
                                <option value="2">Продажи услуг</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ \Auth::user()->referralsCount(true) }}</h2>
                                        <span
                                            class="badge bg-orange font-12 text-white font-weight-medium badge-pill ml-2 d-lg-block d-md-none">+1</span>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">к-во партнёров</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="user-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium"><sup
                                            class="set-doller">$</sup>18,306</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">инвестиции
                                    </h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><sup class="set-doller">$</sup>1234</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">всего пополнений</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium"><sup class="set-doller">$</sup>1234</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">всего выведено</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Общий доход: $124312</h4>
                                <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                <ul class="list-style-none mb-0">
                                    <li>
                                        <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                        <span class="text-muted">Инвестиции</span>
                                        <span class="text-dark float-right font-weight-medium">$2346</span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                        <span class="text-muted">Комиссии</span>
                                        <span class="text-dark float-right font-weight-medium">$2108</span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                        <span class="text-muted">Обучение и франшизы</span>
                                        <span class="text-dark float-right font-weight-medium">$1204</span>
                                    </li>                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Средний процент в мес 5,4%*</h4>
                                <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                <ul class="list-inline text-center mt-5 mb-2">
                                    <li class="list-inline-item text-muted font-italic">*общий процент заработка по месяцам</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">История дивидендов</h4>
                                <div class="mt-4 activity">
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Продажа франшизы</h5>
                                            <p class="font-14 mb-2 text-muted">Ваш партнёр Иван Иванов приобрел франшизу #1. Ваш бонус: $23.</p>
                                            <span class="font-weight-light font-14 text-muted">10 мин назад</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)"
                                                class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="message-square"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Новый запрос в поддержку</h5>
                                            <p class="font-14 mb-2 text-muted">Ваш партнёр Богдан Фёдоров задал вопрос в тикет-системе. Ответьте!</p>
                                            <span class="font-weight-light font-14 text-muted">25 мин назад</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="bell"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Пополнение счета на $<span>12312</span>
                                            </h5>
                                            <p class="font-14 mb-2 text-muted">Используйте все возможности платформы!</p>
                                            <span class="font-weight-light font-14 mb-1 d-block text-muted">2 ч назад</span>
                                            <a href="javascript:void(0)" class="font-14 pb-1 border-info text-warning">Посмотреть больше</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Партнёры</h4>
                                    <div class="ml-auto">
                                        <form class="d-flex">
                                            <div class="customize-input d-flex align-items-center" data-toggle="tooltip" title="Реферальная ссылка. Скопируйте и отправьте тому, кого хотите пригласить.">
                                                <input class="form-control custom-shadow custom-radius border-0 bg-white text-dark pl-3 pr-3" value="monegra.space/?ref=1241212" aria-label="reflink" disabled="">
                                                <i class="form-control-icon icon-docs ml-3"></i>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0"></th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Имя и почта
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Источник
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">Бонусы</th>
                                                <th class="border-0"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-top-0 text-center px-2 py-4"><i
                                                        class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                        data-placement="top" title="новичок"></i></td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="assets/images/users/widget-table-pic1.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Анна Ростова</h5>
                                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">соц. сети</td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center">$123
                                                </td>
                                                <td class="border-top-0 dropdown sub-dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                        <a class="dropdown-item disabled text-muted" href="#">Посмотреть детальную информацию</a>
                                                        <a class="dropdown-item disabled text-muted" href="#">Передать партнёра другому наставнику</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center px-2 py-4"><i
                                                        class="fa fa-circle text-success font-12" data-toggle="tooltip"
                                                        data-placement="top" title="опытный"></i>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="assets/images/users/widget-table-pic2.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Денис Детров
                                                            </h5>
                                                            <span class="text-muted font-14">Kristeen@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">соц. сети</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$213</td>
                                                <td class="dropdown sub-dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                        <a class="dropdown-item disabled text-muted" href="#">Посмотреть детальную информацию</a>
                                                        <a class="dropdown-item disabled text-muted" href="#">Передать партнёра другому наставнику</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center px-2 py-4"><i
                                                        class="fa fa-circle text-primary font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Новичок"></i>
                                                </td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="assets/images/users/widget-table-pic3.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Юлий Цезарь
                                                            </h5>
                                                            <span class="text-muted font-14">Josephs@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">Таргет</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$123</td>
                                                <td class="dropdown sub-dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                        <a class="dropdown-item disabled text-muted" href="#">Посмотреть детальную информацию</a>
                                                        <a class="dropdown-item disabled text-muted" href="#">Передать партнёра другому наставнику</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-center px-2 py-4"><i
                                                        class="fa fa-circle text-danger font-12" data-toggle="tooltip"
                                                        data-placement="top" title="Приглашение отправлено"></i></td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="assets/images/users/widget-table-pic4.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Анна Заплётная
                                                            </h5>
                                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">Приглашение</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$0</td>
                                                <td class="dropdown sub-dropdown">
                                                    <button class="btn btn-link text-muted dropdown-toggle" type="button"
                                                        id="dd1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i data-feather="more-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dd1">
                                                        <a class="dropdown-item disabled text-muted" href="#">Посмотреть детальную информацию</a>
                                                        <a class="dropdown-item disabled text-muted" href="#">Передать партнёра другому наставнику</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Последние события</h4>
                                <div class="mt-4 activity">
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Продажа франшизы</h5>
                                            <p class="font-14 mb-2 text-muted">Ваш партнёр Иван Иванов приобрел франшизу #1. Ваш бонус: $23.</p>
                                            <span class="font-weight-light font-14 text-muted">10 мин назад</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line pb-3">
                                        <div>
                                            <a href="javascript:void(0)"
                                                class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="message-square"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Новый запрос в поддержку</h5>
                                            <p class="font-14 mb-2 text-muted">Ваш партнёр Богдан Фёдоров задал вопрос в тикет-системе. Ответьте!</p>
                                            <span class="font-weight-light font-14 text-muted">25 мин назад</span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-start border-left-line">
                                        <div>
                                            <a href="javascript:void(0)" class="btn btn-warning text-white btn-circle mb-2 btn-item">
                                                <i data-feather="bell"></i>
                                            </a>
                                        </div>
                                        <div class="ml-3 mt-2">
                                            <h5 class="text-dark font-weight-medium mb-2">Пополнение счета на $<span>12312</span>
                                            </h5>
                                            <p class="font-14 mb-2 text-muted">Используйте все возможности платформы!</p>
                                            <span class="font-weight-light font-14 mb-1 d-block text-muted">2 ч назад</span>
                                            <a href="javascript:void(0)" class="font-14 pb-1 border-info text-warning">Посмотреть больше</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-4">
                                    <h4 class="card-title">Продажи</h4>
                                </div>
                                <div class="table-responsive">
                                    <table class="table no-wrap v-middle mb-0">
                                        <thead>
                                            <tr class="border-0">
                                                <th class="border-0 font-14 font-weight-medium text-muted">ID
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted">Партнёр
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted px-2">Продукт
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">
                                                    Сумма
                                                </th>
                                                <th class="border-0 font-14 font-weight-medium text-muted text-center">Бонус</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">1312</td>
                                                <td class="border-top-0 px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="../assets/images/users/widget-table-pic1.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Анна Ростова</h5>
                                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="border-top-0 text-muted px-2 py-4 font-14">Франшиза #2</td>
                                                <td
                                                    class="border-top-0 text-center font-weight-medium text-muted px-2 py-4">
                                                    $3500
                                                </td>
                                                <td class="font-weight-medium text-dark border-top-0 px-2 py-4 text-center">$350
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted px-2 py-4 font-14">12341</td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="../assets/images/users/widget-table-pic2.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Денис Детров
                                                            </h5>
                                                            <span class="text-muted font-14">Kristeen@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">Курс Profi</td>
                                                <td class="text-center text-muted font-weight-medium px-2 py-4">$3200</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$320</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted px-2 py-4 font-14">652</td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="../assets/images/users/widget-table-pic3.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Юлий Цезарь
                                                            </h5>
                                                            <span class="text-muted font-14">Josephs@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">Курс Guru</td>
                                                <td class="text-center text-muted font-weight-medium px-2 py-4">$10 000</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$1000</td>
                                            </tr>
                                            <tr>
                                                <td class="text-muted px-2 py-4 font-14">674</td>
                                                <td class="px-2 py-4">
                                                    <div class="d-flex no-block align-items-center">
                                                        <div class="mr-3"><img
                                                                src="../assets/images/users/widget-table-pic4.jpg"
                                                                alt="user" class="rounded-circle" width="45"
                                                                height="45" /></div>
                                                        <div class="">
                                                            <h5 class="text-dark mb-0 font-16 font-weight-medium">Анна Заплётная
                                                            </h5>
                                                            <span class="text-muted font-14">hgover@gmail.com</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-muted px-2 py-4 font-14">Франшиза #1</td>
                                                <td class="text-center text-muted font-weight-medium px-2 py-4">$3240</td>
                                                <td class="font-weight-medium text-dark px-2 py-4 text-center">$324</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <footer class="footer text-center text-muted">
                Все права защищены. Разработно студией <a class="text-warning" href="https://sousmlm.com">SousMLM</a>.
            </footer>
        </div>
    </div>

    <div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4 class="modal-title" id="myModalLabel">Операционный баланс: 412 USD</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body pt-0">
                    <ul class="nav nav-tabs mb-3">
                        <li class="nav-item">
                            <a href="#home" data-toggle="tab" aria-expanded="false" class="nav-link active">
                                <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                <span>Пополнение</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#profile" data-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                <span>Вывод</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-settings-outline d-lg-none d-block mr-1"></i>
                                <span>Перевод на финансовый баланс</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="home">
                            <div class="">
                                <div class="">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-3 mb-2 mb-sm-0">
                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                                    aria-orientation="vertical">
                                                    <a class="nav-link active show" id="v-pills-home-tab" data-toggle="pill"
                                                        href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                                        aria-selected="true">
                                                        <i class="mdi mdi-home-variant d-lg-none d-block mr-1"></i>
                                                        <span>С карты</span>
                                                    </a>
                                                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill"
                                                        href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                                        aria-selected="false">
                                                        <i class="mdi mdi-account-circle d-lg-none d-block mr-1"></i>
                                                        <span>С Bitcoin</span>
                                                    </a>
                                                </div>
                                            </div> <!-- end col-->
                                            <div class="col-sm-12 col-lg-9">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                                                        aria-labelledby="v-pills-home-tab">
                                                        <div class="">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Пополнение с карты</h4>
                                                                    <form class="mt-3 row">
                                                                        <div class="form-group col-12">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Номер карты">
                                                                            <small id="name" class="form-text text-muted">Введите номер карты, например, 4149 4900 1234 1234</small>
                                                                        </div>
                                                                        <div class="form-group col-8">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Срок действия">
                                                                            <small id="name" class="form-text text-muted">Введите срок действия карты, например, 08/24</small>
                                                                        </div>
                                                                        <div class="form-group col-4">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="CVV">
                                                                            <small id="name" class="form-text text-muted">CVV-код. Пример: 123</small>
                                                                        </div>
                                                                        <div class="form-group col-8">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="Сумма пополнения">
                                                                            <small id="name" class="form-text text-muted">Введите сумму пополнения, например, 100 (USD)</small>
                                                                        </div>
                                                                        <div class="form-group col-4">
                                                                            <input type="submit" class="btn btn-warning text-white w-100" value="Пополнить">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                                                        aria-labelledby="v-pills-profile-tab">
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h4 class="card-title">Пополнение через Bitcoin</h4>
                                                                    <form class="mt-3 row">
                                                                        <div class="form-group col-12">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" value="0x2134213092314091324102384" disabled="">
                                                                            <small id="name" class="form-text text-muted">Отправьте указанную сумму на кошелек компании</small>
                                                                        </div>
                                                                        <div class="form-group col-5">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="0.0001">
                                                                            <small id="name" class="form-text text-muted">Сумма пополнения в BTC</small>
                                                                        </div>
                                                                        <div class="form-group col-2 pt-2">
                                                                            <span class="opacity-7 text-muted col-12"><i data-feather="repeat"></i></span>
                                                                        </div>
                                                                        <div class="form-group col-5">
                                                                            <input type="text" class="form-control" id="nametext" aria-describedby="name" placeholder="" value="$12341" disabled="">
                                                                            <small id="name" class="form-text text-muted">Сумма пополнения в USD</small>
                                                                        </div>
                                                                        <div class="form-group col-8">
                                                                        </div>
                                                                        <div class="form-group col-4">
                                                                            <input type="submit" class="btn btn-warning text-white w-100" value="Пополнить">
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> <!-- end tab-content-->
                                            </div> <!-- end col-->
                                        </div>
                                        <!-- end row-->
                                    </div> <!-- end card-body-->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <div class="tab-pane show" id="profile">
                            <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim
                                justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis
                                eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum
                                semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor
                                eu, consequat vitae, eleifend ac, enim.</p>
                            <p class="mb-0">Food truck quinoa dolor sit amet, consectetuer adipiscing elit.
                                Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus
                                et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                                ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                                quis enim.</p>
                        </div>
                        <div class="tab-pane" id="settings">
                            <p>Food truck quinoa dolor sit amet, consectetuer adipiscing elit. Aenean
                                commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et
                                magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis,
                                ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa
                                quis enim.</p>
                            <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                                arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam
                                dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus
                                elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula,
                                porttitor eu, consequat vitae, eleifend ac, enim.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Закрыть</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

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
   
    <script src="{{asset('jscopy/feather.min.js')}}"></script>
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('jscopy/sidebarmenu.js')}}"></script>
    <script src="{{asset('jscopy/custom.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/c3/c3.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{asset('jscopy/pages/dashboards/dashboard1.min.js')}}"></script>
@endsection
