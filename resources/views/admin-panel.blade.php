<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <div class="wr-page-panel">

        <div class="panel">

            <div class="panel__wr-search">
                <input class="panel__search">
            </div>

            <header class="panel__header">
                <ul class="panel__header-list">
                    <li class="panel__header-item">пользователь</li>
                    <li class="panel__header-item">ID пользователя</li>
                    <li class="panel__header-item">чек</li>
                    <li class="panel__header-item">количество баллов</li>
                    <li class="panel__header-item">участие в розыгрыше</li>
                    <li class="panel__header-item">выбранный подарок(и) по баллам</li>
                    <li class="panel__header-item">подарок розыгрыша</li>
                    <li class="panel__header-item">получил приз по розыгрышу</li>
                </ul>
            </header>

            <main class="panel__main">
                <ul class="panel__users-list">
                    @foreach ($data as $item)
                        <li class="panel__user-item">
                            <div class="panel__user-person">
                                <div class="panel__user-name">
                                    <span>{{ $item->second_name }}</span>
                                    <span>{{ $item->name }} {{ $item->patronymic }} </span>
                                </div>

                                <div class="panel__user-phone">{{ $item->phone }}</div>
                                <div class="panel__user-email">{{ $item->email }}</div>
                                <div class="panel__user-address">
                                    {{ $item->index }}, {{ $item->area }} обл, г. {{ $item->settlement }}, ул. {{ $item->street }},
                                     д. {{ $item->house }}, кв. {{ $item->appartment }}
                                </div>

                                <div class="panel__user-item-edit"></div>
                            </div>

                            <div class="panel__user-id">{{ $item->id }}</div>

                            <ul class="panel__user-cheques-list">
                                @foreach ($item->cheques as $cheque)
                                    <li class="panel__user-cheques-item">
                                        <div class="panel__user-cheques-is-verified {{ $cheque->verified ? 'panel__user-cheques_green' : 'panel__user-cheques_gray' }}"></div>
                                        <div class="panel__user-cheques-link">{{ $cheque->path }}</div>
                                        <div class="panel__user-cheques-basket" data-id="{{ $cheque->id }}"></div>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="panel__user-wr-balls">
                                <div class="panel__user-balls">{{ $item->balls }}</div>
                                <form name="form-chenge-balls">
                                    <input type="text" name="balls" value="{{ $item->balls }}">
                                    <input type="submit" hidden>
                                </form>
                            </div>

                            <div class="panel__user-wr-lottery">
                                <div class="panel__user-lottery {{ $item->lottery ? 'panel__user-lottery_yes' : 'panel__user-lottery_no' }}"></div>
                            </div>

                            <div class="panel__user-wr-gifts-points">
                                <!-- здесь должно быть что-то чтоб добавлять подарок выбранный пользователем -->
                                <ul class="panel__user-gifts-points-list">
                                    @foreach ($item->gifts_p as $gift)
                                        <li class="panel__user-gifts-points-item">
                                            <div class="panel__user-gifts-points-verified {{ $gift->verified ? 'panel__user-gifts-points-verified_green' : 'panel__user-gifts-points-verified_gray' }}"></div>
                                            <div class="panel__user-gifts-points-name">{{ $gift->name }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="panel__user-wr-gifts-lottery">
                                <!-- здесь должно быть что-то чтоб добавлять подарок -->
                                <div class="panel__user-gifts-lottery">{{ $item->gift_l }}</div>
                            </div>

                            <div class="panel__user-wr-lottery-awarded">
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