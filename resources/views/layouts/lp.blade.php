<!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('lp/img/favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="{{ asset('lp/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/css/swiper-bundle.min.css') }}" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ritofos</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-177834135-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-177834135-1');
    </script>
</head>
<body>
    @php($appLocale = App::getLocale())

    <div id="app" class="wrapper">
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
                <div class="container fix-width">
                    <a class="navbar-brand" href="/">
                        <img class="logo-white" src="{{ asset('lp/img/front/logo.svg') }}" alt="">
                        <img class="logo-dark" src="{{ asset('lp/img/front/logo-dark.svg') }}" alt="">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="#top">@lang('Main')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-nowrap" href="#about-us" style="white-space: nowrap;">@lang('About company')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#project">@lang('Projects')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#profit">@lang('Earnings')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#development">@lang('Developments')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#partners" style="white-space: nowrap;">@lang('Affiliate prog')</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#team">@lang('Command')</a>
                            </li>
                            <li class="nav-item" style="display: flex; align-items: center; margin-left: 5px;">
                                <div id="localeSelect"
                                     aria-hidden="true">
                                    <div class="localeSelect-trigger">
                                        <span>{{ $appLocale }}</span>

                                        <span class="btn-arrow">
                                            <i class="arrow"></i>
                                        </span>
                                    </div>

                                    <div class="localeSelect-options">
                                        <div class="localeSelect-arrow-up"></div>

                                        @foreach(config('app.available_locales') as $option)
                                            <a class="localeSelect-option{{ $appLocale === $option ? ' active' : '' }}"
                                               href="{{ route('locale.set', ['locale' => $option]) }}">{{ $option }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <form class="form-inline mt-2 mt-md-0 login-wrapper">
                            <a href="{{ route('login') }}" class="login btn btn-border my-2 my-sm-0">@lang('Sign In')</a>
                        </form>
                    </div>
                </div>
            </nav>
        </header>

        @yield('content')
        <section class="section form-section">
            <div class="container wow fadeInUp">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <h2>@lang('Have a <strong>question?</strong>')</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-lg-7 col-md-10">
                        <div class="form-wrapper">
                            <form id="support-form" class="needs-validation" action="{{ route('site.support') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <input type="text" autocomplete="off" placeholder="@lang('Name')" class="form-control"
                                               id="firstName" placeholder="" value="" required="">
                                        <div class="invalid-feedback">
                                            @lang('Valid first name is required.')
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <input type="email" autocomplete="off" placeholder="@lang('Mail')" class="form-control"
                                               id="lastName" placeholder="@lang('Surname')" value="" required="">
                                        <div class="invalid-feedback">
                                            @lang('Valid last name is required.')
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-6 mt-2">
                                    <textarea autocomplete="off" placeholder="@lang('Message...')" name="message" id="message"></textarea>
                                </div>
                                <div class="d-flex justify-content-center mt-5">
                                    <button type="submit" class="btn btn-blue">@lang('Send')</button>
                                </div>
                            </form>

                            <div id="success-form" class="text-center success-form" style="display: none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width:70px;height:70px;">
                                    <path style="fill:#ffffff;" d="M12.4 2.2c0.4 0.2 0.5 0.6 0.3 1 -0.2 0.4-0.6 0.5-1 0.3C10.9 3.1 10 2.9 9 2.9c-3.5 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2c0-0.5-0.1-1.1-0.2-1.6 -0.1-0.4 0.1-0.8 0.5-0.9s0.8 0.1 0.9 0.5c0.2 0.6 0.3 1.3 0.3 2 0 4.3-3.5 7.7-7.8 7.7s-7.8-3.5-7.8-7.7S4.7 1.4 9 1.4C10.2 1.4 11.4 1.7 12.4 2.2zM16.7 1.3c0.3-0.3 0.8-0.3 1.1 0 0.3 0.3 0.3 0.8 0 1.1l-9 9c-0.3 0.3-0.8 0.3-1.1 0L5.1 8.8c-0.3-0.3-0.3-0.8 0-1.1 0.3-0.3 0.8-0.3 1.1 0l2.1 2.1L16.7 1.3z"></path>
                                </svg>
                                <div class="h3 mt-3">
                                    @lang('Thank')!
                                </div>
                                <div class="subheading text-medium">
                                    @lang('Your message has been sent')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="menu">
                            <li class="circle-icon">
                                <a href="https://www.facebook.com/groups/ritofoscommunity/" target="_blank"><img src="{{ asset('lp/img/front/icon-fb.svg') }}" alt=""></a>
                            </li>
                            <li class="circle-icon">
                                <a href="https://vk.com/ritofoscommunity" target="_blank"><img src="{{ asset('lp/img/front/icon-vk.svg') }}" alt=""></a>
                            </li>
                            <li class="circle-icon">
                                <a href="https://www.instagram.com/ritofoscommunity/" target="_blank"><img src="{{ asset('lp/img/front/icon-instagram.svg') }}" alt=""></a>
                            </li>
                            <li class="circle-icon">
                                <a href="https://t.me/ritofoscommunity" target="_blank"><img class="telegram" src="{{ asset('lp/img/front/icon-telegram.svg') }}" alt=""></a>
                            </li>
                            <li class="circle-icon email" id="copy-email">
                                <div class="r-tooltip">
                                    <a href="mailto:support@ritofos.pro">
                                        <img src="{{ asset('lp/img/front/icon-mail.svg') }}" alt="">
                                    </a>
                                    <span class="tooltiptext" id="myTooltip">support@ritofos.com</span>
                                    <input type="text" value="support@ritofos.com" id="myInput">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center white-text">(с) 2020 Ritofos. @lang('By using this site, you agree to')
                            <a href="{{ route('site.privacy') }}" class="link">@lang('terms of use')</a></p>
                    </div>
                </div>
            </div>
        </footer>

        <script src="{{ asset('lp/js/jquery.min.js') }}"></script>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('lp/js/jquery.min.js') }}"></script>
    <script src="{{ asset('lp/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('lp/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('lp/js/wow.min.js') }}"></script>
    <script src="{{ asset('lp/js/main.js') }}"></script>
    <script>
        window.replainSettings = {id: '4753d969-f5ea-4aa7-a8aa-db33fe57e25a'};
        (function (u) {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = u;
            var x = document.getElementsByTagName('script')[0];
            x.parentNode.insertBefore(s, x);
        })('https://widget.replain.cc/dist/client.js');
    </script>

    {{-- Смена локали --}}
    <script>
        const selectEl = document.getElementById('localeSelect'),
            selectTriggerEl = selectEl.children[0];

        // Открытие списка
        selectTriggerEl.addEventListener('click', () => {
            selectEl.classList.toggle('active');
        });

        // Закрытие списка при клике вне списка
        document.addEventListener('click', ({target}) => {
            const didClickedOutside = !selectEl.contains(target);

            if (didClickedOutside) {
                selectEl.classList.remove('active');
            }
        });
    </script>

    {{-- Копирование почты --}}
    <script>
        const copyEmailEl = document.getElementById('copy-email');

        copyEmailEl.addEventListener('click', () => {
            if ('copying' in copyEmailEl.dataset) {
                return;
            }

            copyEmailEl.dataset.copying = '';

            const tooltipEl = copyEmailEl.querySelector('#myTooltip'),
                inputEl = copyEmailEl.querySelector('#myInput'),
                tooltipOriginalText = inputEl.value;

            navigator.clipboard.writeText(tooltipOriginalText);

            tooltipEl.innerText = "{!! trans('lp.copied') !!}";

            setTimeout(() => {
                delete copyEmailEl.dataset.copying;

                tooltipEl.innerText = tooltipOriginalText;
            }, 1000);
        });
    </script>
</body>
</html>
