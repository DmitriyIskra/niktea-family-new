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
            <li class="breadcrumbs__item"><a class="breadcrumbs__item__link" href="#0">Подарки</a></li>
        </ul>
    </div>

              
    <div class="more-detailed">

        <!--ТАБЫ для активации нужного more-detailed__tabs_active -->
        <ul class="more-detailed__tabs-list">
            <li class="more-detailed__tabs-item more-detailed__tabs_active" data-type="bonus-prog">Бонусная программа Niktea family</li>
            <li class="more-detailed__tabs-item" data-type="lottery">Призы для розыгрыша в бонусной программе</li>
        </ul>

        <!-- START Окна со списком призов -->
        <!-- активация more-detailed__wr-content_active -->
        <div class="more-detailed__wr-content more-detailed__wr-content-bonus-prog more-detailed__wr-content_active">
            <ul class="more-detailed__content-list more-detailed__content-bonus-prog">
                <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">Базовый уровень</h2>
                    </div>
                    <ul class="more-detailed__bonus-prog-list">
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-30-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <div class="more-detailed__wr-bonus-prog-text">
                                <p class="more-detailed__bonus-prog-text">
                                    <span class="more-detailed__bonus-prog-amount-balls">30 баллов - </span>
                                    <span class="more-detailed__bonus-prog-desc">
                                        <a href="/trainings" title="тренинг по чаю">Тренинг по чаю</a> 
                                    </span>
                                    <span class="more-detailed__bonus-prog-desc-dop">(<span class="more-detailed__bonus-prog-desc-dop-color">От любителя до профессионала</span>)</span>
                                </p>
                                <p class="more-detailed__bonus-prog-text_dop">Просим Вас учитывать, что тренинг будет проходить в Москве</p>
                            </div>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-57-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">57 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Чайник для чая и сахарница с ложкой</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-68-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">68 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Коллекция чая NIKTEA в пирамидках (8 шт)</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-73-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">73 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Зонт автомат</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-77-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">77 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Сумка-холодильник</span>
                            </p>
                        </li> 
                    </ul>
                </li>
                <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">Серебряный уровень</h2>
                    </div>
                    <ul class="more-detailed__bonus-prog-list">
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-85-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">85 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Наша фирменная футболка Niktea</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-94-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">94 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Френч-пресс, 1 л</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-146-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">146 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Чайник заварочный, 600 мл</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-159-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">159 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Подарочный термос и 3 стаканчика</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-228-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">228 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Набор для китайской чайной церемонии, в сумке</span>
                            </p>
                        </li>
                    </ul>
                </li>
                <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">Золотой уровень</h2>
                    </div>
                    <ul class="more-detailed__bonus-prog-list">
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-364-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">364 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Термокружка Bork HT600</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-591-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">591 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Подарочная карта М.Видео или Технопарк на 10 000</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-789-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">789 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Рюкзак UAG STD</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-1045-1-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">1045 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Беспроводной мини-пылесос Bork V515</span>
                            </p>
                        </li>
                        <li class="more-detailed__bonus-prog-item">
                            <div class="more-detailed__bonus-prog-wr-image">
                                <img src="img/content/bonuses-for-balls/bonus-1045-2-balls.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__bonus-prog-text">
                                <span class="more-detailed__bonus-prog-amount-balls">1045 баллов - </span>
                                <span class="more-detailed__bonus-prog-desc">Яндекс станция 2, с Алисой (несколько цветов)</span>
                            </p>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="more-detailed__buttons-list">
                <li class="more-detailed__button-item">
                    <div class="more-detailed__button-back">
                        <a href="/rules">подробнее об акции</a>
                    </div>
                </li>
                <li class="more-detailed__button-item">
                    <div class="more-detailed__button-back more-detailed__to-account">
                        <a href="#">личный кабинет</a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="more-detailed__wr-content more-detailed__wr-content-lottery ">
            <ul class="more-detailed__content-list more-detailed__content-lottery">
                <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">1 этап</h2>
                    </div>
                    <ul class="more-detailed__lottery-list">
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image more-detailed__lottery-wr-image_watch">
                                <img src="img/content/lottery/lottery-level1-1.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <div class="more-detailed__lottery-wr-text">
                                <p class="more-detailed__lottery-text">
                                    Часы HUAWEI WATCH GT 4,  46мм. (набор)  
                                </p>
                                <p class="more-detailed__lottery-text">
                                    Часы Apple Watch SE, 44мм.  
                                </p>
                                <p class="more-detailed__lottery-text">
                                    Часы  Samsung 6, 44мм. 
                                </p>
                            </div>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level1-2.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Фен Dyson Supersonic (hd07) 
                            </p>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level1-3.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Игровая консоль Valve Steam Deck
                            </p>
                        </li>
                    </ul>
                </li>
                {{-- <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">2 этап</h2>
                    </div>
                    <ul class="more-detailed__lottery-list">
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level2-1.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Чайник Bork, K810
                            </p>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level2-2.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Беспроводной вертикальный пылесос Dyson V11
                            </p>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level2-3.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Наушники Apple AirPods Max
                            </p>
                        </li>
                    </ul>
                </li>
                <li class="more-detailed__content-item">
                    <div class="more-detailed__wr-title">
                        <h2 class="more-detailed__title">3 этап</h2>
                    </div>
                    <ul class="more-detailed__lottery-list">
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level3-1.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Xbox Series X
                            </p>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level3-2.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                Отпариватель Bork i700
                            </p>
                        </li>
                        <li class="more-detailed__lottery-item">
                            <div class="more-detailed__lottery-wr-image">
                                <img src="img/content/lottery/lottery-level3-3.webp" alt="Подарок по бонусной программе Niktie family">
                            </div>
                            <p class="more-detailed__lottery-text">
                                GoPro Hero 11 Black
                            </p>
                        </li>
                    </ul>
                </li> --}}
            </ul>

            <ul class="more-detailed__buttons-list">
                <li class="more-detailed__button-item">
                    <div class="more-detailed__button-back">
                        <a href="/rules">подробнее об акции</a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- END Окна со списком призов -->

    </div>


    

    

</main>

@include('template_parts.footer')
@include('template_parts.copyright')
@include('template_parts.label-niktea') 
@include('template_parts.loader')
@include('template_parts.modal-user-blocked')
</body>
</html>


