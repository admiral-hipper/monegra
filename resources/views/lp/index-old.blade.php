@extends('layouts.lp')

@section('content')
    <section id="top" class="container-fluid top-section">

        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <h1>Новый формат <strong>инвестиций</strong></h1>
                    <div class="sub-title">
                        Эксклюзивные условия для инвесторов и партнеров. Золотой стандарт и цифровой актив
                    </div>
                    <a href="{{ route('register') }}" class="btn btn-blue btn-arrow">Инвестировать <span class="arrow"></span></a>
                    <a href="#" class="btn btn-border">Презентация</a>
                </div>
                <div class="col-lg-6"></div>
            </div>
        </div>
    </section>
    <section id="about-us" class="section about-us-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <h2>
                        О компании <br><strong>Ritofos</strong>
                    </h2>
                    <div class="videoWrapper d-block d-lg-none mb-4">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/l5k70lRsIzc" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                    <div>
                        <p>Это уникальный холдинг, который использует современные инструменты инвестирования в крупный
                            системный бизнес.</p>

                        <p>Главная особенность Ritofos в том, что цифровой актив компании подкреплен реальным
                            золотом.</p>

                        <p>Используя простые и понятные инструменты, вы можете построить новое будущее для себя, своих
                            детей, родных и близких.</p>
                        <a href="#" class="btn btn-blue btn-arrow">Подробнее</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 d-none d-lg-block">
                    <div class="videoWrapper">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/l5k70lRsIzc" frameborder="0"
                                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <div class="row icon-wrapper">
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-01"></div>
                    <div class="icon__text">Надежность</div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-02"></div>
                    <div class="icon__text">Пассивный доход</div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-03"></div>
                    <div class="icon__text">Удобство и комфорт</div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-04"></div>
                    <div class="icon__text">Дружное сообщество</div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-05"></div>
                    <div class="icon__text">Поддержка партнёров</div>
                </div>
                <div class="col-xl-2 col-md-4 col-6 d-flex flex-column align-items-center">
                    <div class="icon icon__about-06"></div>
                    <div class="icon__text">Благотвори&shy;тельность</div>
                </div>
            </div>
        </div>
    </section>
    <section id="project" class="section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Какие проекты <br><strong>создаёт холдинг</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center plan-tabs-wrapper">
                <div class="roadmap-wrapper">
                    <div class="tab-switcher first active">
                        2020
                    </div>
                    <div class="tab-switcher second">
                        2021
                    </div>
                    <div class="tab-switcher third">
                        2025
                    </div>
                </div>
            </div>
            <div class="row plan plan-first active">
                <div class="col project__line normal">
                    <div class="project__item normal done">
                        <div class="project__item-icon icon-01"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Graybet</div>
                            <div class="project__item-text">Игровая площадка</div>
                        </div>

                    </div>
                    <div class="project__date normal">15 июня</div>
                </div>

                <div class="col project__line reverse">
                    <div class="project__item reverse done">
                        <div class="project__item-icon icon-02"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Jewerly</div>
                            <div class="project__item-text">Ritofos Jewerly</div>
                        </div>

                    </div>
                    <div class="project__point done"></div>
                    <div class="project__date reverse">20 августа</div>
                </div>

                <div class="col project__line normal">
                    <div class="project__item normal">
                        <div class="project__item-icon icon-03"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos University</div>
                            <div class="project__item-text">Бизнес-университет</div>
                        </div>

                    </div>
                    <div class="project__date normal">31 июля</div>
                </div>

                <div class="col project__line reverse">
                    <div class="project__item reverse">
                        <div class="project__item-icon icon-04"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos BusinessPack</div>
                            <div class="project__item-text">Бизнес-партнёрская программа</div>
                        </div>

                    </div>
                    <div class="project__date reverse">10 августа</div>
                </div>

                <div class="col project__line normal">
                    <div class="project__item normal">
                        <div class="project__item-icon icon-05"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Freelance</div>
                            <div class="project__item-text">Биржа фриланса и гарант-сервис</div>
                        </div>

                    </div>
                    <div class="project__date normal">10 сентября</div>
                </div>

                <div class="col project__line reverse">
                    <div class="project__item reverse last">
                        <div class="project__item-icon icon-06"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Charity</div>
                            <div class="project__item-text">Благотворительный фонд</div>
                        </div>

                    </div>
                    <div class="project__date reverse">25 сентября</div>
                </div>
            </div>
            <div class="row plan plan-second">
                <div class="col project__line normal">
                    <div class="project__item normal">
                        <div class="project__item-icon icon-07"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Power</div>
                            <div class="project__item-text">Производство добавок топлива</div>
                        </div>

                    </div>
                    <div class="project__date normal">1 января 2021</div>
                </div>

                <div class="col project__line reverse">
                    <div class="project__item reverse">
                        <div class="project__item-icon icon-08"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Health</div>
                            <div class="project__item-text">Продукты здорового питания</div>
                        </div>

                    </div>
                    <div class="project__point done"></div>
                    <div class="project__date reverse">20 февраля 2021</div>
                </div>

                <div class="col project__line normal">
                    <div class="project__item normal">
                        <div class="project__item-icon icon-09"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Exchange</div>
                            <div class="project__item-text">Криптовалютная биржа</div>
                        </div>

                    </div>
                    <div class="project__date normal">15 апреля 2021</div>
                </div>

                <div class="col project__line reverse">
                    <div class="project__item reverse">
                        <div class="project__item-icon icon-10"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Social</div>
                            <div class="project__item-text">Социальная сеть</div>
                        </div>

                    </div>
                    <div class="project__point done"></div>
                    <div class="project__date reverse">1 августа 2021</div>
                </div>

                <div class="col project__line normal">
                    <div class="project__item normal last">
                        <div class="project__item-icon icon-11"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos Bank</div>
                            <div class="project__item-text">Онлайн-банк</div>
                        </div>

                    </div>
                    <div class="project__date normal">31 декабря 2021</div>
                </div>
            </div>
            <div class="row plan plan-third">
                <div class="col project__line normal">
                    <div class="project__item normal last">
                        <div class="project__item-icon icon-12"></div>
                        <div class="project__item-wrapper">
                            <div class="project__item-title">Ritofos City</div>
                            <div class="project__item-text">Город будущего</div>
                        </div>

                    </div>
                    <div class="project__date normal">1 января 2025</div>
                </div>

            </div>

        </div>
    </section>
    <section id="profit" class="section profit-section">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Заработок <strong>с холдингом</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-4 col-lg-4 col-10 col-sm-6">
                    <ul>
                        <li>заработок уже в первый день</li>
                        <li>быстрый выход в безубыток</li>
                        <li>достойный пассивный доход</li>
                        <li>выгодная партнёртнёрка</li>
                    </ul>
                </div>
                <div class="col-xl-4 col-lg-4 col-10 col-sm-6">
                    <ul>
                        <li>постоянная возможность вывода</li>
                        <li>круглосуточная поддержка</li>
                        <li>долгосрочные проекты</li>
                        <li>четкая дорожная карта</li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 text-center">
                    <a href="{{ route('register') }}" class="btn btn-blue">Инвестировать</a>
                </div>
            </div>
        </div>
    </section>
    <section id="earn" class="section how-earn-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Как заработать <strong class="text-nowrap">с Ritofos?</strong></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="left mb-4">
                        <img src="{{ asset('lp/img/front/group-1104.svg') }}" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-md-6">
                    <p class="mt-3">Вы покупаете цифровой актив, который увеличивается в количестве на вашем балансе.
                        Это похоже на PoS майнинг.</p>
                    <p>Также цифровой актив увеличивается в цене. То есть, вы можете в любой момент продавать его,
                        зарабатывая на этом.</p>

                    <div class="yellow-border">
                        <p><strong>Чем дольше вы держите актив на своем балансе, тем больше прибыль.</strong></p>
                        <p><strong>Рост цифрового актива подкреплен развитием компании и использованием реального золота
                                в деятельности холдинга.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="development" class="section our-development">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center">Наши <strong>разработки</strong></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-01"></div>
                                    <div class="ourdev-title">Ritofos Graybet</div>
                                    <div class="ourdev-body">
                                        Игровая площадка Ritofos Graybet, которая разрабатывает игры для заработка.
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-02"></div>
                                    <div class="ourdev-title">Ritofos Jewerly</div>
                                    <div class="ourdev-body">
                                        Ювелирный онлайн-магазин для покупки золотых и других украшений
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-03"></div>
                                    <div class="ourdev-title">Ritofos University</div>
                                    <div class="ourdev-body">
                                        Онлайн бизнес-университет, который даёт полезные знания бесплатно
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-04"></div>
                                    <div class="ourdev-title">Ritofos BusinessPack</div>
                                    <div class="ourdev-body">
                                        Программа развития бизнеса и помощь стартапам
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-05"></div>
                                    <div class="ourdev-title">Ritofos Freelance</div>
                                    <div class="ourdev-body">
                                        Биржа фриланса, гарант сервис, доска объявлений
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-06"></div>
                                    <div class="ourdev-title">Ritofos Health</div>
                                    <div class="ourdev-body">
                                        Линейка продуктов для здоровья
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-07"></div>
                                    <div class="ourdev-title">Ritofos Exchange</div>
                                    <div class="ourdev-body">
                                        Крипто-валютная биржа, площадка для аренды криптовалютных роботов
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-08"></div>
                                    <div class="ourdev-title">Ritofos Bank</div>
                                    <div class="ourdev-body">
                                        Мобильный банковский сервис
                                    </div>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="ourdev-wrapper">
                                    <div class="icon icon__ourder-09"></div>
                                    <div class="ourdev-title">Ritofos City</div>
                                    <div class="ourdev-body">
                                        Коттеджный городок с экологичными продуктами, жильём и инфрастуктурой
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Add Pagination -->
                        <div class="swiper-pagination"></div>


                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <a href="{{ route('register') }}" class="btn btn-blue mt-5">Инвестировать</a>
                </div>
            </div>
        </div>
    </section>
    <section id="partners" class="section program-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center">Партнерская <strong>программа</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 col-xl-4">
                    <div class="program-logo program-logo_01"></div>
                    <div class="program-title">Partner Profit Program</div>
                    <div class="program-text">Заработок от дохода партнёров каждый день</div>
                </div>
                <div class="col-lg-6 col-xl-4 offset-xl-1">
                    <div class="program-logo program-logo_02"></div>
                    <div class="program-title">Partner Career Program</div>
                    <div class="program-text">Достигайте уровней и получайте бонусы в Talant и золотых монетах</div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 text-center mt-3">
                    <a href="{{ route('register') }}" class="btn btn-blue">Инвестировать</a>
                </div>
            </div>
        </div>
    </section>
    <section id="team" class="section team-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col">
                    <h2 class="text-center">Наша <strong>команда</strong></h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-4 col-xl-3">
                    <div class="team-wrapper">
                        <div class="photo-border">
                            <div class="photo photo_01"></div>
                        </div>
                        <div class="ourdev-header">
                            Даниил Романов
                        </div>
                        <div class="ourdev-body">
                            Генеральный директор компании, <br>руководитель отдела маркетинга
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="team-wrapper">
                        <div class="photo-border">
                            <div class="photo photo_02"></div>
                        </div>
                        <div class="ourdev-header">
                            Александр Ганиев
                        </div>
                        <div class="ourdev-body">
                            Руководитель отдела <br>образования
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="team-wrapper">
                        <div class="photo-border">
                            <div class="photo photo_03"></div>
                        </div>
                        <div class="ourdev-header">
                            Владимир Алексеев
                        </div>
                        <div class="ourdev-body">
                            Руководитель отдела <br>разработки
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
