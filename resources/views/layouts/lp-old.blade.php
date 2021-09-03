<!doctype html>
<html lang="en-US" prefix="og: http://ogp.me/ns#">
<head>
    <!-- Styles -->
    <link rel="shortcut icon" href="{{ asset('lp/img/favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;subset=cyrillic"
            rel="stylesheet">

    <link href="{{ asset('lp/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('lp/css/swiper-bundle.min.css') }}" rel="stylesheet">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Ritofos</title>
</head>
<body class="">
<div id="app" class="wrapper">
    <header class="">
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark header-dark">
            <div class="container">
                <a class="navbar-brand" href="/"><img src="{{ asset('lp/img/front/logo.svg') }}" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#top">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-nowrap" href="#about-us">О компании</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#project">Проекты</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#profit">Заработок</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#development">Разработки</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#partners">Партнерка</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#team">Команда</a>
                        </li>

                    </ul>
                    <form class="form-inline mt-2 mt-md-0">
                        <a href="{{ route('login') }}" class="btn btn-border btm-small my-2 my-sm-0 ml-4">Войти</a>
                    </form>
                </div>
            </div>
        </nav>

    </header>
    @yield('content')
    <section class="section form-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h2>У вас возник <strong>вопрос?</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-6 col-md-10">
                    <div class="form-wrapper">
                        <form id="support-form" class="needs-validation" action="{{ route('site.support') }}" method="POST">
                            @csrf
                            <div class="h3">
                                <strong></strong>Напишите нам
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <input name="name" type="text" autocomplete="off" placeholder="Имя" class="form-control"
                                           id="firstName" placeholder="" value="" required="">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <input name="email" type="email" autocomplete="off" placeholder="Email" class="form-control"
                                           id="lastName" placeholder="" value="" required="">
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="mb-6">
                                <textarea autocomplete="off" placeholder="Сообщение" name="message" id="message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-blue btn-arrow w-100">Отправить<span class="arrow"></span>
                            </button>
                        </form>

                        <div id="success-form" class="text-center" style="display: none">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" style="width:70px;height:70px;">
                                <path style="fill:#31C94B;"
                                      d="M12.4 2.2c0.4 0.2 0.5 0.6 0.3 1 -0.2 0.4-0.6 0.5-1 0.3C10.9 3.1 10 2.9 9 2.9c-3.5 0-6.2 2.8-6.2 6.2s2.8 6.2 6.2 6.2 6.2-2.8 6.2-6.2c0-0.5-0.1-1.1-0.2-1.6 -0.1-0.4 0.1-0.8 0.5-0.9s0.8 0.1 0.9 0.5c0.2 0.6 0.3 1.3 0.3 2 0 4.3-3.5 7.7-7.8 7.7s-7.8-3.5-7.8-7.7S4.7 1.4 9 1.4C10.2 1.4 11.4 1.7 12.4 2.2zM16.7 1.3c0.3-0.3 0.8-0.3 1.1 0 0.3 0.3 0.3 0.8 0 1.1l-9 9c-0.3 0.3-0.8 0.3-1.1 0L5.1 8.8c-0.3-0.3-0.3-0.8 0-1.1 0.3-0.3 0.8-0.3 1.1 0l2.1 2.1L16.7 1.3z"></path>
                            </svg>
                            <div class="h3">Спасибо!</div>
                            <p class="subheading grey-color text-medium">Ваше сообщение отправлено</p>
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
                        <li class="circle-icon"><a href="#" target="_blank"><img class="" src="{{ asset('lp/img/front/icon-fb.svg') }}"
                                                                                 alt=""></a></li>
                        <li class="circle-icon"><a href="#" target="_blank"><img class="" src="{{ asset('lp/img/front/icon-vk.svg') }}"
                                                                                 alt=""></a></li>
                        <li class="circle-icon"><a href="#" target="_blank"><img src="{{ asset('lp/img/front/icon-instagram.svg') }}"
                                                                                 alt=""></a></li>
                        <li class="circle-icon"><a href="#" target="_blank"><img class="telegram"
                                                                                 src="{{ asset('lp/img/front/icon-telegram.svg') }}"
                                                                                 alt=""></a></li>
                        <li class="circle-icon email" onclick="myFunction()" onmouseout="outFunc()">
                            <div class="r-tooltip">
                                <img src="{{ asset('lp/img/front/icon-mail.svg') }}" alt="">
                                <span class="tooltiptext" id="myTooltip">Скопировать</span>
                                <input type="text" value="support@ritofos.pro" id="myInput">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center white-text">(с) 2020 Ritofos. Пользуясь данным сайтом, вы соглашаетесь с
                        <a href="/privacy" class="link">правилами использования</a></p>
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
<script src="{{ asset('lp/js/main.js') }}"></script>

<script>

</script>
</body>
</html>
