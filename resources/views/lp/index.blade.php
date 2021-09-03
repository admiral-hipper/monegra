@extends('layouts.lp', ['bodyClass'  => 'home'])

@section('content')
    <section id="top" class="container-fluid top-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-xl-5 col-lg-6 d-flex flex-row align-items-center">
                    <div class="top-title">
                        <img class="d-block d-lg-none coin-side" src="{{ asset('lp/img/front/coin-side.png') }}">
                        <h1>@lang('New format for <strong>investments</strong>')</h1>
                        <div class="sub-title">
                            @lang('Exclusive conditions') <br>@lang('for investors and partners').
                            <br>@lang('Gold standard and digital asset')
                        </div>
                        <div class="d-flex flex-md-row flex-md-nowrap flex-column flex-wrap justify-content-center justify-content-lg-start">
                            <a href="{{ route('register') }}" class="btn btn-blue btn-arrow">@lang('Invest')
                                <span class="arrow"></span></a>
                            <a href="{{ route('site.promo') }}" target="_blank" class="btn btn-border">@lang('Presentation')</a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1">
                </div>
            </div>
        </div>
    </section>

    <section class="section about-us-section">
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xl-5 col-lg-6 col-md-12">
                    <div class="position-relative">
                        <div class="videoWrapper">
                            <iframe width="560" height="315" src="https://www.youtube.com/embed/IKZ_giOp_bA" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <span class="strips d-none d-lg-block">
                            <img src="{{ asset('lp/img/front/strips.svg') }}" alt="">
                        </span>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 offset-xl-1 col-md-12 position-relative z-3">
                    <div id="about-us" class="about-border">
                        <h2>
                            @lang('About company') <br><strong>Ritofos</strong>
                        </h2>
                        <div>
                            <p>@lang('This is a unique holding that uses modern investment instruments in large systemic businesses.')</p>

                            <p>@lang('The main feature of Ritofos is that the company\'s digital asset is backed by real gold.')</p>

                            <p class="pb-4">@lang('Using simple and straightforward tools related with MLM, you can build a new future for yourself, their children, relatives and friends.')</p>
                            <a href="#profit" class="btn btn-blue btn-arrow">@lang('More details')</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row icon-wrapper wow fadeInUp mt-md-0 mt-4">
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-01"></div>
                        <div class="icon__text">@lang('Reliability')</div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-02"></div>
                        <div class="icon__text">@lang('Passive income')</div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-03"></div>
                        <div class="icon__text">@lang('Convenience and comfort')</div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-04"></div>
                        <div class="icon__text">@lang('Friendly community')</div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-05"></div>
                        <div class="icon__text">@lang('Partner support')</div>
                    </div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon-item">
                        <div class="icon icon__about-06"></div>
                        <div class="icon__text">@lang('Social programs')</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="project" class="section project">
        <div class="container-fluid">
            <div class="oval-bg">
                <a href="#plan" class="round-arrow"></a>
            </div>
            <div class="row z-3 position-relative">
                <div class="col">
                    <h2 class="text-center pb-0">@lang('What projects does he create')
                        <br><strong>@lang('holding')</strong></h2>
                </div>
            </div>
            <div id="plan" class="row justify-content-center plan-tabs-wrapper">
                <div class="roadmap-wrapper">
                    <div class="tab-switcher first active">
                        2020-2021
                    </div>
                    <div class="tab-switcher second">
                        2022-2025
                    </div>
                    <div class="tab-switcher third">
                        2026-2030
                    </div>
                </div>
            </div>
            <div class="wow fadeInUp">
                <div class="row plan plan-first active justify-content-center">
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                <div class="project__date d-flex flex-row justify-content-start align-items-end">
                                    <span class="p-day">15</span>
                                    <span class="p-month">@lang('september')</span>
                                </div>
                                <div class="project__item-title">Graybet
                                    <span style="font-size: 65%">(@lang('upd.'))</span></div>
                                <div class="project__item-text">@lang('Business Gaming Platform')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_graybet_w.svg') }}" alt="">
                            </div>
                            <span class="bottom"></span>
                            <span class="left first"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__empty"></div>
                        <div class="project__item d-flex flex-row justify-content-between  align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">20</span>
                                    <span class="p-month">сентября</span>
                                </div>--}}
                                <div class="project__item-title">Jewerly</div>
                                <div class="project__item-text">@lang('Jewelry online store')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_jewerly.svg') }}" alt="">
                            </div>
                            <span class="left"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between  align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">31</span>
                                    <span class="p-month">октября</span>
                                </div>--}}
                                <div class="project__item-title">University</div>
                                <div class="project__item-text">@lang('Business University')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_university.svg') }}" alt="">
                            </div>
                            <span class="top"></span>
                            <span class="bottom"></span>
                            <span class="left"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__empty"></div>
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{-- <div class="project__date">
                                     <span class="p-day">10</span>
                                     <span class="p-month">ноября</span>
                                 </div>--}}
                                <div class="project__item-title">BusinessPack</div>
                                <div class="project__item-text">@lang('Business affiliate program')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_business.svg') }}" alt="">
                            </div>
                            <span class="left"></span>
                            <span class="bottom"></span>
                        </div>
                    </div>
                </div>
                <div class="row plan plan-second justify-content-center">
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{-- <div class="project__date">
                                     <span class="p-day">10</span>
                                     <span class="p-month">декабря</span>
                                 </div>--}}
                                <div class="project__item-title">Marketplace</div>
                                <div class="project__item-text">@lang('Marketplace for goods and services')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_freelance.svg') }}" alt="">
                            </div>
                            <span class="bottom"></span>
                            <span class="left first"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__empty"></div>
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">25</span>
                                    <span class="p-month">декабря</span>
                                </div>--}}
                                <div class="project__item-title">Charity</div>
                                <div class="project__item-text">@lang('Charitable foundation')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_charity.svg') }}" alt="">
                            </div>
                            <span class="left"></span>
                        </div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9  d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">20</span>
                                    <span class="p-month">февраля 2021</span>
                                </div>--}}
                                <div class="project__item-title">Ritofos Health</div>
                                <div class="project__item-text">@lang('Healthy food products')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_health.svg') }}" alt="">
                            </div>
                            <span class="top"></span>
                            <span class="left"></span>
                            <span class="bottom"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>

                    {{--<div class="col-12 col-sm-10 col-md-9  d-flex flex-row justify-content-center align-items-center">
                        <div class="project__empty"></div>
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                <div class="project__date">
                                    <span class="p-day">1</span>
                                    <span class="p-month">августа 2021</span>
                                </div>
                                <div class="project__item-title">Ritofos Social </div>
                                <div class="project__item-text">Социальная сеть </div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_social.svg') }}" alt="">
                            </div>
                            <span class="left"></span>
                        </div>
                    </div>

                    <div class="col-12 col-sm-10 col-md-9  d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                <div class="project__date">
                                    <span class="p-day">31</span>
                                    <span class="p-month">декабря 2021</span>
                                </div>
                                <div class="project__item-title">Ritofos Bank </div>
                                <div class="project__item-text">Онлайн-банк  </div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_bank.svg') }}" alt="">
                            </div>
                            <span class="bottom"></span>
                            <span class="top"></span>
                            <span class="left"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>--}}
                </div>
                <div class="row plan plan-third justify-content-center">
                    <div class="col-12 col-sm-10 col-md-9 d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">1</span>
                                    <span class="p-month">января 2021</span>
                                </div>--}}
                                <div class="project__item-title">Ritofos Power</div>
                                <div class="project__item-text">@lang('Fuel additive production')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_petrol.svg') }}" alt="">
                            </div>
                            <span class="bottom"></span>
                            <span class="left first"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>
                    <div class="col-12 col-sm-10 col-md-9  d-flex flex-row justify-content-center align-items-center">
                        <div class="project__empty"></div>
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">15</span>
                                    <span class="p-month">апреля 2021</span>
                                </div>--}}
                                <div class="project__item-title">Ritofos Exchange</div>
                                <div class="project__item-text">@lang('Cryptocurrency exchange') </div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_exchange.svg') }}" alt="">
                            </div>
                            <span class="left"></span>
                        </div>

                    </div>
                    <div class="col-12 col-sm-10 col-md-9  d-flex flex-row justify-content-center align-items-center">
                        <div class="project__item d-flex flex-row justify-content-between align-items-center">
                            <div class="project__data">
                                {{--<div class="project__date">
                                    <span class="p-day">1</span>
                                    <span class="p-month">января 2028</span>
                                </div>--}}
                                <div class="project__item-title">Ritofos City</div>
                                <div class="project__item-text">@lang('City of the future')</div>
                            </div>
                            <div class="project__icon">
                                <img src="{{ asset('lp/img/front/icon_city.svg') }}" alt="">
                            </div>
                            <span class="top"></span>
                            <span class="bottom"></span>
                            <span class="left"></span>
                        </div>
                        <div class="project__empty"></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <section id="profit" class="section profit-section ">
        <div class="container wow fadeInUp">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">@lang('Earnings with <strong>holding</strong>')</h2>
                </div>
            </div>
            <div class="row justify-content-between position-relative">
                <div class="col-xl-4 col-lg-6 col-12 col-sm-12">
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-01"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Earnings already on the first day')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-02"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Quick exit to breakeven')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-03"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Decent passive income')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-04"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Profitable affiliate program')</div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-10 col-sm-12">
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-05"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Permanent withdrawal option')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-06"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('24/7 support')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-07"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Long term projects')</div>
                        </div>
                    </div>
                    <div class="profit-item d-flex flex-row align-items-center">
                        <div class="profit-img-wrapper">
                            <div class="profit-img profit-img-08"></div>
                        </div>
                        <div>
                            <div class="profit-text">@lang('Clear roadmap')</div>
                        </div>
                    </div>
                </div>
                <div class="coin-rotate">
                    <div id="coin"></div>
                </div>
                <div class="line-dots-bg"></div>
            </div>
        </div>
    </section>

    <section id="earn" class="section how-earn-section">
        <div class="container wow fadeInUp">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">@lang('How to make money with <strong class="text-nowrap">Ritofos?</strong>')</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-5 col-lg-6 col-md-12">
                    <div class="left mb-4 text-center">
                        <img src="{{ asset('lp/img/front/graphic.svg') }}" class="img-graphic img-fluid w-100" alt="">
                    </div>
                </div>
                <div class="col-xl-6 offset-xl-1 col-lg-6 col-md-12">
                    <div class="top-strip-wrapper">
                        <p>@lang('Buy a digital asset and keep it in a deposit account, due to which you will receive dividends.')</p>
                        <p class="pb-3">@lang('Also, the digital asset is increasing in value against gold (XAU). That is, you can make money on the difference in the exchange rate.')</p>
                    </div>

                    <div class="quote-block">
                        <p>@lang('The digital asset combines modern technology and the gold standard of the past.') </p>
                        <p>@lang('The gold standard means that at any time you can make a request to exchange an asset for real gold.')</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="development" class="section our-development">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center">@lang('Our <strong>developments</strong>')</h2>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row swiper-container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-01"></div>
                                            <div class="ourdev-title">Ritofos Graybet</div>
                                            <div class="ourdev-body">
                                                @lang('Platform with products in the field of business gaming, investment and partnership programs')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-02"></div>
                                            <div class="ourdev-title">Ritofos Jewerly</div>
                                            <div class="ourdev-body">
                                                @lang('Online store for buying gold and other jewelry')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-03"></div>
                                            <div class="ourdev-title">Ritofos University</div>
                                            <div class="ourdev-body">
                                                @lang('Online business university with courses in financial literacy')
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-04"></div>
                                            <div class="ourdev-title">Ritofos BusinessPack</div>
                                            <div class="ourdev-body">
                                                @lang('An online business university that provides useful knowledge for free')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-05"></div>
                                            <div class="ourdev-title">Ritofos Freelance</div>
                                            <div class="ourdev-body">
                                                @lang('Freelance exchange, guarantor service, bulletin board')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-06"></div>
                                            <div class="ourdev-title">Ritofos Health</div>
                                            <div class="ourdev-body">
                                                @lang('Health product line')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-07"></div>
                                            <div class="ourdev-title">Ritofos Exchange</div>
                                            <div class="ourdev-body">
                                                @lang('Cryptocurrency exchange, a platform for renting cryptocurrency robots')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-08"></div>
                                            <div class="ourdev-title">Ritofos Bank</div>
                                            <div class="ourdev-body">
                                                @lang('Mobile banking service')
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="ourdev-wrapper">
                                            <div class="icon icon__ourder-09"></div>
                                            <div class="ourdev-title">Ritofos City</div>
                                            <div class="ourdev-body">
                                                @lang('Cottage town with eco-friendly products, housing and infrastructure')
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Pagination -->
                                <div class="swiper-pagination"></div>
                                <div class="swiper-button-prev"></div>
                                <div class="swiper-button-next"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 d-flex justify-content-center mt-5">
                    <a href="{{ route('register') }}" class="btn btn-blue mt-5">@lang('Invest')</a>
                </div>
            </div>
        </div>
    </section>

    <section id="partners" class="section program-section dots-bg">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center mb-0 pb-4">@lang('Affiliate <strong>program</strong>')</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="program-logo program-logo_01"></div>
                    <div class="program-title mb-4">Profit Partner Program</div>
                    <div class="program-text">@lang('Earning from partners income every day')</div>
                </div>
                <div class="col-lg-6 col-xl-4 offset-xl-1">
                    <div class="program-logo program-logo_02"></div>
                    <div class="program-title mb-4">Career Partner Program</div>
                    <div class="program-text">@lang('Reach levels and get bonuses in Talant and gold coins')</div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center mt-5 pt-3 d-flex justify-content-center">
                    <a href="{{ route('register') }}" class="btn btn-blue">@lang('Invest')</a>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="section team-section">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center">@lang('Our <strong>team</strong>')</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="team-wrapper">
                        <div class="photo-border">
                            <div class="photo photo_01"></div>
                        </div>
                        <div class="ourdev-header mb-4">
                            @lang('Daniil Romanov')
                        </div>
                        <div class="ourdev-body">
                            @lang('General director of the company, <br>head of marketing department')
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-6">
                    <div class="team-wrapper">
                        <div class="photo-border">
                            <div class="photo photo_02"></div>
                        </div>
                        <div class="ourdev-header mb-4">
                            @lang('Alexander Ganiev')
                        </div>
                        <div class="ourdev-body">
                            @lang('Head of Education Department')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
