<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/admin.css">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="wr-page-panel">

        <div class="panel">

            <div class="panel__wr-search">
                <input class="panel__search" placeholder="Поиск">
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
                        <li class="panel__user-item">
                            <div class="panel__user-item-content panel__user-person">
                                <div class="panel__user-fio">
                                    <span class="{{ !$item->user_active ? 'panel__user-name_red' : ''}}">{{ $item->second_name }}</span>
                                    <span class="{{ !$item->user_active ? 'panel__user-name_red' : ''}}">{{ $item->name }} {{ $item->patronymic }} </span>
                                </div>

                                <div class="panel__user-info panel__user-phone">{{ $item->phone }}</div>
                                <div class="panel__user-info panel__user-email">{{ $item->email }}</div>
                                <div class="panel__user-info panel__user-address">
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

                                <div class="panel__user-item-edit"></div>
                            </div>

                            <div class="panel__user-item-content panel__user-id">{{ $item->id }}</div>

                            <ul class="panel__user-item-content panel__user-cheques-list">
                                @foreach ($item->cheques as $cheque)
                                    <li class="panel__user-cheques-item">
                                        <div class="panel__user-cheques-content">
                                            <div
                                                class="panel__user-cheques-is-verified {{ $cheque->verified ? 'panel__user-cheques_green' : 'panel__user-cheques_gray' }}"
                                                data-verified="{{ $cheque->verified }}"
                                             ></div>
                                            <div class="panel__user-cheques-link">{{ $cheque->path }}</div>
                                        </div>
                                        <div class="panel__user-cheques-basket" data-id="{{ $cheque->id }}"></div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="panel__user-item-content panel__user-wr-balls">
                                <div class="panel__user-balls">{{ $item->balls }}</div>
                                <form name="form-chenge-balls">
                                    <input type="text" name="balls" value="{{ $item->balls }}">
                                    <input type="submit"  hidden>
                                </form>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-lottery">
                                <div class="panel__user-lottery {{ $item->lottery ? 'panel__user-lottery_yes' : 'panel__user-lottery_no' }}"></div>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-gifts-points">
                            {{--    <!-- здесь должно быть что-то чтоб добавлять подарок выбранный пользователем -->
                                <ul class="panel__user-gifts-points-list">
                                    @foreach ($item->gifts_for_points as $gift)
                                        <li class="panel__user-gifts-points-item">
                                            <div class="panel__user-gifts-points-verified {{ $gift->verified ? 'panel__user-gifts-points-verified_green' : 'panel__user-gifts-points-verified_gray' }}"></div>
                                            <div class="panel__user-gifts-points-name">{{ $gift->name }}</div>
                                        </li>
                                    @endforeach
                                </ul>--}}
                            </div>

                            <div class="panel__user-item-content panel__user-wr-gifts-lottery">
                                <!-- здесь должно быть что-то чтоб добавлять подарок -->
                                <div class="panel__user-gifts-lottery">{{ $item->gift_for_lottery }}</div>
                            </div>

                            <div class="panel__user-item-content panel__user-wr-lottery-awarded">
                                <div class="panel__user-lottery-awarded {{ $item->awarded ? 'panel__user-lottery-awarded_yes' : 'panel__user-lottery-awarded_no' }}"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </main>
        </div>

    </div>
</body>
</html>