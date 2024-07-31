<!DOCTYPE html>
<html lang="ru">

<head>
    @include('template_parts.header_css_js')
    <link rel="stylesheet" href="{{ asset("css/page-error.css?v=").time()}}">
    <link rel="stylesheet" href="{{ asset("css/rules.css?v=").time()}}">
    <link rel="stylesheet" href="{{ asset("css/winners.css?v=").time()}}">
    <title>Страница не найдена</title>
</head>

<body data-variant="error-page">

<header>
    <div class="header-wrapper header-wrapper--white">

        <nav class="navbar__wrap navbar-expand-lg">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-navq header__list">
                    <li class="header__item">
                        <a href="/trainings" class="header__link">Наши тренинги</a>
                    </li>
                    <li class="header__item">
                        <a href="#" class="header__link">Правила акции</a>
                    </li>

                    <li class="nav-item header__logo d-none d-lg-block"> <a href="/"><img class="header__logo--img" src="{{ asset('img/icons/logo.svg') }}"
                                                                                               alt="logo"></a></li>

                    <li class="header__item">
                        <a href="/winners" class="header__link">Подарки</a>
                    </li>
                    <li class="header__item">
                        <button class="header__button" id="userAccount"><a href="/account">Личный кабинет</a></button>
                    </li>
                </ul>
            </div>

        </nav>
        <a class="navbar-brand d-lg-none logo-mobile--wrap" href="#">
            <img src="{{ asset('img/icons/logo-mobile.svg') }}" alt="logo-mobile">
        </a>
        <a class="navbar-brand d-lg-none account-logo-mobile" href="/account">
        </a>

    </div>
</header>

@include('template_parts.modal')
<main class="main">



    <div class="error-page__container">


        <section class="error__page__section">

            <span class="warning__oi">Ой, ошибка</span>

            <h1 class="error__head">404</h1>

            <span class="warning__error">Такой страницы нет,<br> но Вы на верном пути!<br> Перейдите, пожалуйста, на страницы:</span>



            <div class="back-buttons__wrap">
                <button class="back-button">главная страница</button>
                <button class="back-button">личный кабинет</button>
            </div>


    </div>



    </section>

    </div>

</main>

@include('template_parts.footer')
@include('template_parts.copyright')
@include('template_parts.label-niktea')
@include('template_parts.loader')
@include('template_parts.modal-user-blocked')
</body>
</html>
