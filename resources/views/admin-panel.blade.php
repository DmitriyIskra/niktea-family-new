<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/app.js" type="module" defer></script>
    <title>{{ $title }}</title>
</head>
<body>
    <div class="wr-page-panel">

        <div class="panel">

            <div class="panel__wr-search-logout">
                <input class="panel__search" placeholder="Поиск">
                <a class="panel__logout" type="button" href="/logout">Выход</a>
            </div>

            <header class="panel__header">
                <ul class="panel__header-list">
                    <li class="panel__header-item panel__header-item_person">пользователь</li>
                    <li class="panel__header-item panel__header-item_id">ID пользователя</li>
                    <li class="panel__header-item panel__header-item_cheque">чек</li>
                    <li class="panel__header-item panel__header-item_balls">количество баллов</li>
                    <li class="panel__header-item panel__header-item_lottery">участие в розыгрыше</li>
                    <li class="panel__header-item panel__header-item_bonus-p">выбранный подарок(и) по баллам</li>
                    <li class="panel__header-item panel__header-item_bonus-l">подарок розыгрыша</li>
                    <li class="panel__header-item panel__header-item_awarded">получил приз по розыгрышу</li>
                </ul>
            </header>

            <main class="panel__main">
                <ul class="panel__users-list">
                    @foreach ($data as $item)
                        <li class="panel__user-item" data-user_id="{{ $item->id }}" data-is_active="{{ $item->user_active }}">
                            <div class="panel__user-item-content panel__user-person panel__scrollbar">
                                <div class="panel__user-fio {{ !$item->user_active ? 'panel__user-fio_red' : ''}}"
                                    data-second_name={{ $item->second_name }}
                                    data-name={{ $item->name }}
                                    data-patronymic={{ $item->patronymic }}
                                >
                                    <span class="panel__user-fio_second_name">{{ $item->second_name }}</span>
                                    <span class="panel__user-fio_name-patronymic">{{ $item->name }} {{ $item->patronymic }} </span>
                                </div>

                                <div class="panel__user-info panel__user-phone">{{ $item->phone }}</div>
                                <div class="panel__user-info panel__user-email">{{ $item->email }}</div>
                                <div class="panel__user-info panel__user-address"
                                    data-index="{{ $item->index !== 'null' ? $item->index : '' }}"
                                    data-area="{{ $item->area }}"
                                    data-district="{{ $item->district }}"
                                    data-settlement="{{ $item->settlement }}"
                                    data-street="{{ $item->street }}"
                                    data-house="{{ $item->house }}"
                                    data-appartment="{{ $item->appartment }}"
                                >
                                    {{ 
                                        $item->index ? $item->index.", " : '' 
                                    }} {{ 
                                        $item->area ? $item->area." обл, " : '' 
                                    }} {{ 
                                        $item->district ? $item->district."р-он, " : ''
                                    }} г. {{ $item->settlement }}, ул. {{ $item->street }},
                                     д. {{ $item->house }}, {{ 
                                        $item->appartment ? "кв. ".$item->appartment : ''
                                     }}
                                </div>

                                <div class="panel__user-item-edit panel__user-item-edit_user-data"></div>
                            </div>

                            <div class="panel__user-item-content panel__user-id">{{ $item->id }}</div>

                            <ul class="panel__user-item-content panel__user-cheques-list panel__scrollbar">
                                @foreach ($item->cheques as $cheque)
                                    <li class="panel__user-cheques-item">
                                        <div class="panel__user-cheques-content">
                                            <div
                                                class="panel__circle-verified {{ $cheque->verified ? 'panel__circle-verified_green' : 'panel__circle-verified_gray' }}"
                                                data-verified="{{ $cheque->verified }}"
                                                data-id="{{ $cheque->id }}"
                                             ></div>
                                            <div class="panel__user-cheques-link">{{ $cheque->path }}</div>
                                            <div class="panel__user-cheques-basket" data-id="{{ $cheque->id }}"></div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="panel__user-item-content panel__user-wr-balls" data-is_active="0">
                                <div class="panel__user-balls">{{ $item->balls }}</div>
                                {{-- panel__form-change-balls_active --}}
                                <form class="panel__form-change-balls panel__form-add-one-value" name="form-change-balls">
                                    <input type="text" name="balls">
                                    <input type="submit"  hidden>
                                </form>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-lottery panel_wr-checkmark">
                                <div class="panel_checkmark {{ $item->lottery ? 'panel_checkmark_yes' : 'panel__panel_checkmark_no' }}"></div>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-gifts-points">
                                <div class="panel__wr-add-gift-points">
                                    {{-- panel__form-gift-points_active --}}
                                    <form class="panel__form-gift-points" name="form-gifts-points">
                                        <input type="text" name="gift-points">
                                        <input type="submit"  hidden>
                                    </form>

                                    <div class="panel__user-item-edit panel__user-item-edit_gift-p"></div>
                                </div>
                                <ul class="panel__user-gifts-points-list panel__scrollbar">
                                    @if ($item->gifts_for_points)    
                                        @foreach ($item->gifts_for_points as $gift)
                                            <li class="panel__user-gifts-points-item">
                                                <div class="panel__circle-verified {{ $gift->verified ? 'panel__circle-verified_green' : 'panel__circle-verified_gray' }}"></div>
                                                <div class="panel__user-gifts-points-name">{{ $gift->name }}</div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-gifts-lottery">
                                {{-- panel__form-gifts-lottery_active --}}
                                <form class="panel__form-gifts-lottery panel__form-add-one-value" name="form-gifts-lottery">
                                    <input type="text" name="gift-lottery" value="{{ $item->gift_for_lottery }}">
                                    <input type="submit"  hidden>
                                </form>
                                <div class="panel__user-gifts-lottery">{{ $item->gift_for_lottery }}</div>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-lottery-awarded panel_wr-checkmark">
                                <div class="panel_checkmark {{ $item->awarded ? 'panel_checkmark_yes' : 'panel__panel_checkmark_no' }}"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </main>

            {{-- modal-edit_active --}}
            <div class="modal-edit">
                <div class="modal-panel__wr-close">
                    <div class="modal-panel__close modal-edit_close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                            <path d="M1.76471 1.76465L26.7214 26.7214" stroke="#424242" stroke-width="3" stroke-linecap="round"/>
                            <path d="M26.4706 1.76465L1.76471 26.4705" stroke="#424242" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>

                <div class="modal-edit__content">
                    {{-- modal-edit__user-is-blocked_active --}}
                    <div class="modal-edit__user-is-blocked">Профиль заблокирован</div>

                    <form class="modal-edit__form">
                        @csrf
                        <ul class="modal-edit__contact-list">
                            <li class="modal-edit__contact-wr-item modal-edit__second-name">
                                <input type="text" class="modal-edit__input modal-edit__contact-input" name="second_name" value="Фамилия">
                            </li>
                            <li class="modal-edit__contact-wr-item modal-edit__name">
                                <input type="text" class="modal-edit__input modal-edit__contact-input" name="name" value="Имя">
                            </li>
                            <li class="modal-edit__contact-wr-item modal-edit__patronymic">
                                <input type="text" class="modal-edit__input modal-edit__contact-input" name="patronymic" value="Отчество">
                            </li>
                            <li class="modal-edit__contact-wr-item modal-edit__phone">
                                <input type="text" class="modal-edit__input modal-edit__contact-input" name="phone" value="Номер телефона">
                            </li>
                            <li class="modal-edit__contact-wr-item modal-edit__email">
                                <input type="text" class="modal-edit__input modal-edit__contact-input" name="email" value="Email">
                            </li>
                        </ul>

                        <ul class="modal-edit__address-list">
                            <li class="modal-edit__address-wr-item modal-edit__index">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="index" value="Индекс">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__area">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="area" value="Область">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__district">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="district" value="Район">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__settlement">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="settlement" value="Город">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__street">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="street" value="Улица">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__house">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="house" value="Дом">
                            </li>
                            <li class="modal-edit__address-wr-item modal-edit__appartment">
                                <input type="text" class="modal-edit__input modal-edit__address-item" name="appartment" value="Квартира">
                            </li>
                        </ul>

                        <div class="modal-edit__wr-buttons">
                            <button class="modal-panel__button modal-panel__button_delete" type="button">Удалить</button>
                            <button class="modal-panel__button modal-panel__button_block" type="button" name="blocking"></button>
                            <button class="modal-panel__button modal-panel__button_submit" type="button">Готово</button>
                        </div>
                    </form>
                </div>
                
            </div>

            {{-- modal-confirmation_active --}}
            <div class="modal-confirmation">
                <div class="modal-panel__wr-close">
                    <div class="modal-panel__close modal-confirmation_close">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" fill="none">
                            <path d="M1.76471 1.76465L26.7214 26.7214" stroke="#424242" stroke-width="3" stroke-linecap="round"/>
                            <path d="M26.4706 1.76465L1.76471 26.4705" stroke="#424242" stroke-width="3" stroke-linecap="round"/>
                        </svg>
                    </div>
                </div>

                <div class="modal-confirmation__content"></div>
                
                <div class="modal-confirmation__wr-buttons">
                    <button class="modal-panel__button modal-confirmation__button_agree" type="button"></button>
                    <button class="modal-panel__button modal-confirmation__button_cancel" type="button">Отмена</button>
                </div>
            </div>
        </div>

    </div>
    @include('template_parts.loader')
</body>
</html>