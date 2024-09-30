<!DOCTYPE html>
<html lang="ru">

<head>
    @include('template_parts.header_css_js')
    <title>Бренд NIktea устраиваем розыгрыш призов в честь 15-летия чайного бренда NIktea!</title>
    <meta name="description" content="Наши призы: сертификат на путешествие мечты, Macbook, IPhone, Sony PlayStation, электросамокат Bork, годовой запас чая NIktea и многое другое!"/>
    <link rel="stylesheet" href="{{ asset("css/rules.css?v=").time()}}">
    <link rel="stylesheet" href="{{ asset("css/winners.css?v=").time()}}">

</head>

<body class="main-body__image" data-variant="main-page">

<header>
    <div class="header-wrapper header-wrapper--white">
        @include('template_parts.header_menu')
    </div>
</header>
@include('template_parts.modal')
<main class="main rules-prog__main">
 
    <div class="breadcrumbs__container">
        <ul class="breadcrumbs__list">
            <li class="breadcrumbs__item"><a class="breadcrumbs__item__link" href="/">Главная</a></li>
            <li class="breadcrumbs__item"><a class="breadcrumbs__item__link" href="#0">Правила проведения акции</a></li>
        </ul>
    </div>

    <div class="rules-prog__container">
        <div class="rules-prog__item-card">
            <div class="rules-prog__head">
                <h1>Бонусная программа</h1>
            </div>

            <section class="rules">

                <div class="rules-body">

                    <div class="rules-article">
                        <h2 class="rules-prog__title">Niktea Family – это клуб любителей чая Niktea</h2>
                        <ul class="rules-prog__list">
                            <li class="rules-prog__item">
                                <div class="rules-prog__item-wr-title">
                                    <h2 class="rules-prog__item-title">Покупайте чай Niktea</h2>
                                </div>

                                <div class="rules-prog__item-wr-content">
                                    <div class="rules-prog__annotation">(в акции участвуют порционный чай в пирамидках и пакетированный чай на чашку)</div>
                                    <p class="rules-prog__text-content">
                                        Чай Вы можете купить на сайте нашего официального интернет-магазина Oasis MSK,
                                        а также у наших партнеров: Ozon, Vprok, в магазинах Окей, Гипер Глобус, Перекресток и других.
                                    </p>
                                </div>
                            </li>
                            <li class="rules-prog__item">
                                <div class="rules-prog__item-wr-title">
                                    <h2 class="rules-prog__item-title">Регистрируйте чеки в личном кабинете</h2>
                                </div>

                                <div class="rules-prog__item-wr-content">
                                    <p class="rules-prog__text-content">Фотографии чека должны соответствовать следующим техническим требованиям:</p>
                                    <ol class="rules-prog__content-list">
                                        <li class="rules-prog__content-item rules-prog__text-content">Тип файла: JPEG, PNG, JPG, BMP;</li>
                                        <li class="rules-prog__content-item rules-prog__text-content">Размер не более 5 Мб;</li>
                                        <li class="rules-prog__content-item rules-prog__text-content">Размер по большей стороне до 2048px;</li>
                                        <li class="rules-prog__content-item rules-prog__text-content">Чеки от покупки должны быть технически качественными (читаемыми). Не допускаются изображения, не являющиеся фотографиями</li>
                                    </ol>
                                    <div class="rules-prog__annotation">(оттиски, картинки, компьютерная графика, фотомонтаж).</div>
                                </div>
                            </li>
                            <li class="rules-prog__item">
                                <div class="rules-prog__item-wr-title">
                                    <h2 class="rules-prog__item-title">Копите баллы</h2>
                                </div>

                                <div class="rules-prog__item-wr-content">
                                    <p class="rules-prog__text-content rules-prog__text-content_color">
                                        (1 пачка = 1 балл)
                                    </p>
                                </div>
                            </li>
                            <li class="rules-prog__item">
                                <div class="rules-prog__item-wr-title">
                                    <h2 class="rules-prog__item-title">Обменивайте баллы на подарки</h2>
                                </div>

                                <div class="rules-prog__item-wr-content">
                                    <p class="rules-prog__text-content rules-prog__text-content_color">
                                        Все участники, получившие подарки, примут участие в розыгрыше главных призов
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>

            </section>
        </div>

        {{-- <div class="rules-prog__item-card rules-prog__item-card_second">
            <div class="rules-prog__head">
                <h2>Правила участия в розыгрыше</h2>
            </div>

            <section class="rules">

                <div class="rules-body">

                    <div class="rules-article">
                        <h2>Бренду Niktea исполняется 15 лет!</h2>
                        <p class="rules-body--text">
                            В честь этой важной для нас даты мы устраиваем розыгрыш призов, среди которых: сертификат на путешествие мечты, Macbook, IPhone, Sony PlayStation, электросамокат Bork и многое другое!
                            <br><br>
                            В 2008 году родился новый бренд – Niktea. Мы прошли долгий путь, сосредотачиваясь на качестве и бережно сохраняя неизменным вкус нашего чая, постоянно совершенствуясь, разрабатывая новые купажи, дизайны и рецепты.
                            <br><br>
                            Niktea — это уникальная коллекция превосходного свежего чая и чайных напитков со всех уголков света — от классического черного и зеленого чая до ароматизированных, фруктовых и травяных композиций.
                            <br><br>
                            Спустя 15 лет, с нашим брендом познакомились тысячи любителей чая.
                            <br><br>
                            Мы ценим каждого покупателя и хотим поделиться этим праздником с Вами!
                        </p>
                    </div>

                </div>

            </section>
        </div> --}}

    </div>

    <div class="rules-docs">
        <div class="docs_links__wrap">
            <p>
                <span>Скачать правила</span>
                {{-- <span>в бонусной программе</span> --}}
            </p>
            <div class="docs__wr-icon">
                <img src="img/pdf-icon.webp" alt="Document1">
            </div>
            <a class="docs__link__icon" href="Правила Niktea Family.pdf" target="_blank" rel="nofollow"></a>
        </div>
        {{-- <div class="docs_links__wrap">
            <p>
                <span>Правила участия</span> 
                <span>в розыгрыше</span>   
            </p>
            <div class="docs__wr-icon">
                <img src="img/pdf-icon.webp" alt="Document1">
            </div>
            <a class="docs__link__icon" href="привила_проведения_промо_акции_Niktea.pdf" target="_blank"  rel="nofollow"></a>
        </div> --}}
    </div>

</main>

@include('template_parts.footer')
@include('template_parts.copyright')
@include('template_parts.label-niktea') 
@include('template_parts.loader')
@include('template_parts.modal-user-blocked')
</body>
</html>


