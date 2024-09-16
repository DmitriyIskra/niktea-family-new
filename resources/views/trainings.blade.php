<!DOCTYPE html>
<html lang="ru">

<head>
    @include('template_parts.header_css_js')
    <title>Промостраница в честь 15-летия чайного бренда NIktea!</title>
    <meta name="description" content="Наши призы: сертификат на путешествие мечты, Macbook, IPhone, Sony PlayStation, электросамокат Bork, годовой запас чая NIktea и многое другое!"/>
    <link rel="stylesheet" href="{{ asset("css/trainings.css?v=").time()}}">
</head>

<body class="main-body__image" data-variant="trainings-page">
    <div class="trainings-page__wrapper">

        <header>
            <div class="header-wrapper header-wrapper__trainings-page header-wrapper--white">
                @include('template_parts.header_menu') 
            </div>
        </header>
        
        <!-- Вход, регистрация -->

        @include('template_parts.modal')

        <main class="main trainings-page__main">

                <div class="breadcrumbs__container">
                    <ul class="breadcrumbs__list">
                        <li class="breadcrumbs__item"><a class="breadcrumbs__item__link" href="/">Главная</a></li>
                        <li class="breadcrumbs__item"><a class="breadcrumbs__item__link" href="/trainings">Наши тренинги</a></li>
                    </ul>
                </div>

            <div class="trainings-page__container">

                <div class="trainings-page__wr-title">
                    <h1 class="trainings-page__title">От любителя до профессионала</h1>
                    <p>Базовый курс</p>
                </div>

                <div class="trainings-page__wr-description">
                    <article class="trainings-page__description">
                        <p>
                            Вы узнаете из чего делают чай, какой чай можно считать качественным, научитесь его правильно заваривать, чтобы всегда получать вкусный напиток. На курсе вы освоите технику дегустации чая от профессионального титестера. Научитесь, как сомелье определять вкусы и ароматы в чае. И сможете удивить своими знаниями коллег, знакомых и родных.
                        </p>
                    </article>
                </div>

                <ul class="trainings-page__img-list">
                    <li class="trainings-page__img-item">
                        <img src="img/content/trainings-page-image-1.webp" alt="чайная церемония" class="trainings-page__image">
                    </li>
                    <li class="trainings-page__img-item">
                        <img src="img/content/trainings-page-image-2.webp" alt="чайная церемония" class="trainings-page__image">
                    </li>
                </ul>

                <section class="course-plan__wrapper">
                    <div class="course-plan__wr-title">
                        <h2 class="course-plan__title">План курса</h2>
                    </div>


                    <div class="course-plan__about-tea">

                        <section class="course-plan__wrapper-card">
                            <div class="course-plan__card-wr-title">
                                <h2 class="course-plan__card-title">О чае</h2>
                            </div>
                            <ul class="course-plan__card-list">
                                <li class="course-plan__card-item">
                                    <p>Чай, разновидности, сбор</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p> Происхождение, влияние терруара на чай (совокупность почвенно-климатических факторов местности)</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Этапы производства</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Виды чая (обработка: от зелёного до пуэра)</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Химический состав и свойства</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Как правильно заваривать чай (какое количество, какая температура заваривания, в какой посуде)</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Хранение чая</p>
                                </li>
                            </ul>
                        </section>
                        
                        <ul class="trainings-page__img-list course-plan__img-list">
                            <li class="trainings-page__img-item course-plan__img-item">
                                <img src="img/content/trainings-page__about-tea-img-1.webp" alt="курс о чае">
                            </li>
                            <li class="trainings-page__img-item course-plan__img-item">
                                <img src="img/content/trainings-page__about-tea-img-2.webp" alt="курс о чае">
                            </li>
                        </ul>

                    </div>

                    <div class="course-plan__tasting">
                        <section class="course-plan__wrapper-card">
                            <div class="course-plan__card-wr-title">
                                <h2 class="course-plan__card-title">Дегустация чая (титестинг)</h2>
                            </div>

                            <ul class="course-plan__card-list">
                                <li class="course-plan__card-item">
                                    <p>Попробуйте разные виды чая и узнаете, в чем их отличие по вкусу в зависити от технологии обработки</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Научитесь определять ароматы как настоящие сомелье (титестеры)</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Узнаете как отличить сырье высокого качества от низкого</p>
                                </li>
                                <li class="course-plan__card-item">
                                    <p>Научитесь сербать/хлюпать, как профессиональные дегустаторы чая</p>
                                </li>
                            </ul>
                        </section>
                        
                        <ul class="trainings-page__img-list course-plan__img-list">
                            <li class="trainings-page__img-item course-plan__img-item">
                                <img src="img/content/trainings-page__tasting-img-1.webp" alt="дегустация чая">
                            </li>
                            <li class="trainings-page__img-item course-plan__img-item">
                                <img src="img/content/trainings-page__tasting-img-2.webp" alt="дегустация чая">
                            </li>
                        </ul>

                    </div>
                        
                </section>


            </div>

            <div class="trainings-page__wr-proposal">
                <div class="trainings-page__proposal">
                    <p>
                        Копите баллы и обменивайте их на тренинг
                    </p>
                </div>
            </div>

        </main>



        @include('template_parts.footer')
        @include('template_parts.copyright')
        @include('template_parts.label-niktea')
        @include('template_parts.loader')
        @include('template_parts.modal-user-blocked')
    </div>
</body>
</html>
