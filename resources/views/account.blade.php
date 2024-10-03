<!DOCTYPE html>
<html lang="ru">

<head>
    @include('template_parts.header_css_js')
    <title>Ваш личный кабинет на промостранице бренда Niktea</title>
    <meta name="description" content="Здесь вы можете выиграть путешествие, главные или чайные призы."/>
</head>

<body data-variant="user-account">

<body data-variant="user-account">

<header>
    <div class="header-wrapper header-wrapper--white">
        @include('template_parts.header_menu')
    </div>
</header> 

@include('template_parts.modal')

<main class="main">



    <div class="user-account__container">

        <section class="user-account">

            <div class="account-form">
                <div class="wr-exit">
                    <div class="wr-button-exit">
                        <a class="log-out__button" href="/logout">ВЫХОД</a>
                    </div>
                </div>
                <div class="user_wr-title">
                    <h1>Личный кабинет</h1>
                    @if ( $data->lottery && !$data->awarded)
                        <div class="user_prezent-icon" data-lottery={{ $data->lottery  && !$data->awarded ? "true" : "false" }}></div>
                    @endif
                </div>
                <div class="user__wr-balance">
                    <p>Ваш баланс: <span class="user__balance">{{ $data->balls }}</span>  баллов</p>
                </div>

                <div class="user__data">
                    <div class="data-item green--border account__lastname">{{ $data->second_name }}</div>
                    <div class="data-item btn-gradient-2 account__firstname">{{ $data->name }}</div>
                    <div class="data-item account__patronymic">{{ $data->patronymic }}</div>
                    <div class="data-item account__phone">{{ $data->phone }}</div>
                    <div class="data-item account__mail">{{ $data->email }}</div>

                    <ul class="user-data__address-list">
                        <li class="user-data__address-item user-data__address-item_first">
                            <div class="user-data__data user-data__data_index">{{ $data->index }}</div>
                            <div class="user-data__data user-data__data_area">{{ $data->area }}</div>
                            <div class="user-data__data user-data__data_district">{{ $data->district }}</div>
                        </li>
                        <li class="user-data__address-item user-data__address-item_second">
                            <div class="user-data__data user-data__data_city">{{ $data->settlement }}</div>
                            <div class="user-data__data user-data__data_street">{{ $data->street }}</div>
                            <div class="user-data__data-numbers">
                                <div class="user-data__data user-data__data_house">{{ $data->house }}</div>
                                <div class="user-data__data user-data__data_apartment">{{ $data->appartment }}</div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="up-cheque"> 
                    <div class="up-cheque__notice up-cheque__notice_success">Ваш чек успешно загружен</div>
                    <div class="up-cheque__notice up-cheque__notice_fail">Не удалось загрузить чек, попробуйте еще раз</div>
                    <div class="up-cheque__notice up-cheque__notice_no-valid">Файл должен быть изображением и не превышать 10мб</div>
                    <div class="up-cheque__notice up-cheque__notice_no-limit">За один раз Вы можете выбрать не более 6 чеков</div>

                    <form class="up-cheque__wr-form" name="form-cheque">
                            @csrf
                            <div class="up-cheque__upload-cheque">
                                <label>
                                    <input type="file" name="file[]" id="up-cheque__upload-cheque" multiple accept="image/*">
                                </label>
                                <div class="up-cheque__button-back" for="#up-cheque__upload-cheque">
                                    <button type="button">загрузить фото чека</button>
                                </div>
                            </div> 
                    </form>
                    
                    <div class="up-cheque__instruction">
                        <p>Убедитесь, что Ваш чек хорошо читается, а также он не должен превышать 10Мб и файл должен быть изображением.</p>
                        <p>Баллы будут начислены после проверки чека. В случае если ваш чек некорректен, баллы не будут начислены!</p>
                    </div>

                    <div class="up-cheque__back-wr-preview">
                        <div class="up-cheque__wr-preview">
                            <div class="up-cheque__preview-wr-close">
                                <div class="up-cheque__preview-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                                        <g clip-path="url(#clip0_3031_1566)">
                                            <path d="M1.76465 1.76465L26.7214 26.7214" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                            <path d="M26.4705 1.76465L1.76465 26.4705" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3031_1566">
                                                <rect width="30" height="30" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>

                            <ul class="up-cheque__preview-list">
                                <!-- Для превью загруженных чеков -->
                            </ul>
    
                            <div class="up-cheque__preview-wr-button">
                                <div class="up-cheque__button-back up-cheque__button-back_submit">
                                    <button type="button">отправить</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="exchange__wrapper">
                    <div class="exchange__wr-title">
                        <h2 class="exchange__title">Обмен баллов</h2>
                    </div>  

                    <div class="exchange__wr-extraction">
                        <div class="exchange__wr-level-title">
                            <h2 class="exchange__level-title">Базовый уровень</h2>
                        </div>
                        <ul class="exchange__extraction-list">
                            <li class="exchange__extraction-item exchange__extraction-item_first">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-30-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text exchange__extraction-text_wr-dop">
                                        <span class="exchange__balls">30 баллов - </span><span class="exchange__name">тренинг по чаю</span> <span class="exchange__extraction-text_color">“От любителя до профессионала”</span>
                                        <span class="exchange__extraction-text-dop">(<span class="exchange__extraction-text-dop_color">проводится в Москве</span>)</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button"> <!-- баллы к кнопке прикручиваются в data-points через js -->
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-57-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">57 баллов - </span> <span class="exchange__name">чайник для чая и сахарница</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-68-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">68 баллов - </span> <span class="exchange__name">коллекция NIKTEA в пирамидках</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-73-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">73 баллов - </span> <span class="exchange__name">зонт автомат</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-77-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">77 баллов - </span> <span class="exchange__name">сумка-холодильник</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>                 
                        </ul>

                        <div class="exchange__wr-level-title">
                            <h2 class="exchange__level-title">Серебряный уровень</h2>
                        </div>
                        <ul class="exchange__extraction-list">
                            <li class="exchange__extraction-item exchange__extraction-item_first">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-85-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">85 баллов - </span> <span class="exchange__name">фирменная футболка Niktea</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-94-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">94 баллов - </span> <span class="exchange__name">френч-пресс, 1 л</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-146-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">146 баллов - </span> <span class="exchange__name">чайник заварочный, 600 мл</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-159-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">159 баллов - </span> <span class="exchange__name">термос и 3 стаканчика</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-228-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">228 баллов - </span> <span class="exchange__name">набор для чайной церемонии</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>                 
                        </ul>

                        <div class="exchange__wr-level-title">
                            <h2 class="exchange__level-title">Золотой уровень</h2>
                        </div>
                        <ul class="exchange__extraction-list">
                            <li class="exchange__extraction-item exchange__extraction-item_first">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-364-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">364 баллов - </span> <span class="exchange__name">термокружка Bork HT600</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-591-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">591 баллов - </span> <span class="exchange__name">подарочная карта М.Видео или Технопарк на 10 000</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-789-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">789 баллов - </span> <span class="exchange__name">рюкзак UAG STD</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-1045-1-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">1045 баллов - </span> <span class="exchange__name">беспроводной мини-пылесос Bork V515</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>
                            <li class="exchange__extraction-item">
                                <div class="exchange__extraction-descr">
                                    <div class="exchange__extraction-img">
                                        <img src="img/content/bonuses-for-balls/bonus-1045-2-balls.webp" alt="extraction">
                                    </div>
                                    <p class="exchange__extraction-text">
                                        <span class="exchange__balls">1045 баллов - </span> <span class="exchange__name">яндекс станция 2, с Алисой</span>
                                    </p>
                                </div>
                                <div class="exchange__extraction-wr-button">
                                    <div class="exchange__extraction-button-back">
                                        <button type="button">
                                            <span class="exchange__extraction-button-text">обменять</span>
                                        </button>
                                    </div>
                                </div>
                            </li>                 
                        </ul>

                        <div class="exchange__wr-price">
                            <p class="exchange__price">1 пачка чая = 1 балл</p>
                        </div>
                    </div>

                    <!-- класс активации - exchange__modal-wrapper_active -->
                    <div class="exchange__modal-wrapper">
                        <!-- класс активации самой модалки -  exchange__modal_active -->
                        <div class="exchange__modal-confirm">
                            <div class="exchange__modal-wr-close">
                                <div class="exchange__modal-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                                        <g clip-path="url(#clip0_3031_1566)">
                                            <path d="M1.76465 1.76465L26.7214 26.7214" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                            <path d="M26.4705 1.76465L1.76465 26.4705" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3031_1566">
                                                <rect width="30" height="30" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
    
                            <div class="exchange__modal-confirm-wr-title">
                                <h1 class="exchange__modal-confirm-title">
                                    Подтвердите Ваш адрес доставки:
                                </h1>
                            </div>
    
                            <div class="exchange__modal-confirm-wr-address">
                                <div class="exchange__modal-confirm-address"></div>
                            </div>
    
                            <div class="exchange__modal-confirm-wr-submit">
                                <div class="exchange__modal-button-back exchange__modal-confirm-submit">
                                    <button type="button">подтвердить</button>
                                </div>
                            </div>
    
                            <div class="exchange__modal-confirm-wr-change">
                                <div class="exchange__modal-button-back exchange__modal-confirm-change">
                                    <button type="button">изменить адрес</button>
                                </div>
                            </div>
                        </div>

                        <div class="exchange__modal-change">
                            <div class="exchange__modal-wr-close">
                                <div class="exchange__modal-close">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                                        <g clip-path="url(#clip0_3031_1566)">
                                            <path d="M1.76465 1.76465L26.7214 26.7214" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                            <path d="M26.4705 1.76465L1.76465 26.4705" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_3031_1566">
                                                <rect width="30" height="30" fill="white"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>

                            <form class="exchange__modal-change-address-list" name="changeAddress">
                                @csrf
                                <div class="exchange__modal-change-address-item">
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-index" name="index">
                                    </div>
                                </div>
                                <div class="exchange__modal-change-address-item">
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-area" name="area">
                                    </div>
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-district" name="district">
                                    </div>
                                </div>
                                <div class="exchange__modal-change-address-item">
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-city" name="city">
                                    </div>
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-street" name="street">
                                    </div>
                                </div>
                                <div class="exchange__modal-change-address-item">
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-house" name="house">
                                    </div>
                                    <div class="exchange__modal-change-address-wr">
                                        <input type="text" class="exchange__modal-change-apartment" name="apartment">
                                    </div>
                                </div>
                            </form>

                            <div class="exchange__modal-change-wr-buttons">
                                <div class="exchange__modal-button-back exchange__modal-confirm-save">
                                    <button type="button">сохранить</button>
                                </div>
                                <div class="exchange__modal-button-back exchange__modal-confirm-cancel">
                                    <button type="button">отмена</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="code__group">      

                    <div class="slider__group">

                        <h1>Ваши чеки</h1>

                        <div class="chequebook">
                            <ul class="chequebook__cheque-list">

                            </ul>
                            <div class="chequebook__pagination">
                                <div class="chequebook__arrow chequebook__arrow-prev">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 20" fill="none">
                                        <path d="M10 2L2 10L10 18" stroke="white" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <div class="chequebook__wr-pagination-list">
                                    <ul class="chequebook__pagination-list">
                                        <!-- фото чеков подгружаются сюды -->
                                    </ul>
                                </div>

                                <div class="chequebook__arrow chequebook__arrow-next">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 20" fill="none">
                                        <path d="M2 2L10 10L2 18" stroke="white" stroke-width="2.5" stroke-linecap="square" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>

                            <!-- chequebook__wr-zoom_active -- класс активации zoom -->
                            <div class="chequebook__wr-zoom">
                                <div class="chequebook__wr-close-zoom">
                                    <div class="chequebook__close-zoom">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                                            <g clip-path="url(#clip0_3167_1396)">
                                                <path d="M1.76465 1.76465L26.7214 26.7214" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                                <path d="M26.4705 1.76465L1.76465 26.4705" stroke="white" stroke-width="3" stroke-linecap="round"/>
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_3167_1396">
                                                    <rect width="30" height="30" fill="white"/>
                                                </clipPath>
                                            </defs>
                                        </svg>
                                    </div>
                                </div>
                                <div class="chequebook__wr-image-zoom">
                                    <img src="#" class="chequebook__img-zoom"></img>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>


    <!-- 
                    -- == ИНСТРУКЦИЯ == --
       --- === МАЛЕНЬКИЕ ИНФОРМАЦИОННЫЕ МОДАЛКИ === --- 
                 для класса "api-res__wrapper"

        api-res__wrapper_active - активация api-res -> подключается к api-res__wrapper
        --------------------------------------------
        -- классы ниже подключаются к api-res__wrapper и меняют содержимое
        api-res__lottery - Вы стали участником розыгрыша!
        api-res__no-enough - Для этого заказа у Вас не хватает баллов.
        api-res__success - Ваш запрос успешно отправлен. Менеджер с Вами свяжется.
        api-res__fail-send - Проблема с соединением, попробуйте еще.
        api-res__cheque-success - Ваш чек успешно добавлен. Время проверки чека до 7 дней.
    -->
    <div class="api-res__wrapper">
        <div class="api-res__window">
            <div class="api-res__content">
                <div class="api-res__content-icon"></div>
                <div class="api-res__content-wr-text">
                    <p class="api-res__content-text api-res__content-text_lottery">После обмена баллов <br> Вы стали участником розыгрыша!</p>                
                    <p class="api-res__content-text api-res__content-text_no-enough">Для этого заказа у Вас не хватает баллов.</p>                
                    <p class="api-res__content-text api-res__content-text_success">Ваш запрос успешно отправлен. Менеджер с Вами свяжется.</p>                
                    <p class="api-res__content-text api-res__content-text_fail-send">Проблема с соединением, попробуйте еще.</p>                
                    <p class="api-res__content-text api-res__content-text_cheque-success">Ваш чек успешно добавлен. <br> <span class="api-res__content-text_color">Время проверки чека до 7 дней.</span></p>                
                </div>
                <div class="api-res__content-wr-button">
                    <div class="api-res__content-button-back">
                        <a href="/rules" title="Вы стали участником розыгрыша!">подробнее</a>
                    </div>
                </div>
            </div> 
            <div class="api-res__close">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                    <path d="M1.76465 1.76465L26.7214 26.7214" stroke="white" stroke-width="3" stroke-linecap="round"/>
                    <path d="M26.4705 1.76465L1.76465 26.4705" stroke="white" stroke-width="3" stroke-linecap="round"/>
                </svg>
            </div>
        </div>
    </div>
</main>


@include('template_parts.footer')
@include('template_parts.copyright')
@include('template_parts.loader')
@include('template_parts.label-niktea')
<!-- событие на кнопку выход -->
<script>
    // logout()
</script>
</body>
</html>
