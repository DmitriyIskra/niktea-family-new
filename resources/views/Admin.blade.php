<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Админка</title>
    <style>
        table {
            width: 100%;
            border: none;
            margin-bottom: 20px;
            padding-left: 10%;
            padding-right: 10%;
            margin-top: 1%;
        }

        table thead th {
            font-weight: bold;
            text-align: left;
            border: none;
            padding: 10px 15px;
            background: #97f8e4;
            font-size: 14px;
            border-left: 1px solid #4d9f9b;
            border-right: 1px solid #4d9f9b;
        }

        table tbody td {
            text-align: left;
            border-left: 1px solid #4d9f9b;
            border-right: 1px solid #4d9f9b;
            padding: 10px 15px;
            font-size: 14px;
            vertical-align: top;
        }

        table thead tr th:last-child, table tbody tr td:last-child {
            border-right: none;
        }

        .tra{
            background: #d1ffe6;
        }
        .search_box {
            position: relative;
            width: 50%;
            padding-left: 25%;
            padding-top: 3%;
        }

        .search_box input[type="text"] {
            display: block;
            width: 100%;
            height: 35px;
            line-height: 35px;
            padding: 0;
            margin: 0;
            border: 1px solid #9f9897;
            outline: none;
            overflow: hidden;
            border-radius: 0px;
            background-color: rgb(255, 255, 255);
            text-indent: 15px;
            font-size: 14px;
            color: #222;
            /*border-right: 0;*/
        }

        .search_box input[type="submit"] {
            display: inline-block;
            width: 40%;
            height: 37px;
            padding: 0;
            margin: 0;
            border: 0;
            outline: 0;
            overflow: hidden;
            background-color: #8bbbdc;
            color: #FFF;
            border: 1px solid #9f9897;
        }

        /* Стили для плашки с результатами */
        .search_result {
            position: absolute;
            top: 100%;
            left: 0;
            border: 1px solid #ddd;
            background: #fff;
            padding: 10px;
            z-index: 9999;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .flex {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: nowrap;
            flex-direction: column;
            align-content: center;
        }

        .preloader {
            /*фиксированное позиционирование*/
            position: fixed;
            /* координаты положения */
            left: 0;
            top: 0;
            right: 0;
            bottom: 0;
            /* фоновый цвет элемента */
            background: #e0e0e0;
            /* размещаем блок над всеми элементами на странице (это значение должно быть больше, чем у любого другого позиционированного элемента на странице) */
            z-index: 1001;
        }

        .preloader__row {
            position: relative;
            top: 50%;
            left: 50%;
            width: 70px;
            height: 70px;
            margin-top: -35px;
            margin-left: -35px;
            text-align: center;
            animation: preloader-rotate 2s infinite linear;
        }

        .description {
            margin-bottom: 15px;
            font-size: 20px;
        }

        .preloader__item {
            position: absolute;
            display: inline-block;
            top: 0;
            background-color: #337ab7;
            border-radius: 100%;
            width: 35px;
            height: 35px;
            animation: preloader-bounce 2s infinite ease-in-out;
        }

        .preloader__item:last-child {
            top: auto;
            bottom: 0;
            animation-delay: -1s;
        }

        @keyframes preloader-rotate {
            100% {
                transform: rotate(360deg);
            }
        }

        @keyframes preloader-bounce {

            0%,
            100% {
                transform: scale(0);
            }

            50% {
                transform: scale(1);
            }
        }
    </style>
    <script
        src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>
</head>
<body>
<div class="search_box">
    <form action="">
        <div class="flex">
            <label class="description">Для начала поиска начните вводить код</label>
            <input type="text" name="search" id="search" placeholder="Введите код с пачки">
            <!--<input type="submit">-->
        </div>
    </form>
    <div id="search_box-result">
    </div>
    <div class="preloader">
        <div class="preloader__row">
            <div class="preloader__item"></div>
            <div class="preloader__item"></div>
        </div>
    </div>
</div>
<table>
    <thead>
    <tr>
        <th>Пользователь</th>
        <th>Код</th>
        <th>Чек</th>
        <th>Время регистрации чека</th>
        <th>Выиграл чайный приз?</th>
        <th>Название чайного приза</th>
        <th>Когда вручение чайного приза (Пример: "19-02-2023")</th>
        <th>Выиграл главный приз?</th>
        <th>Название главного приза</th>
        <th>Когда вручение главного приза (Пример: "19-02-2023")</th>
    </tr>
    </thead>
    <tbody id="for-parse">

    </tbody>
</table>
</body>
<script>
    $('.preloader').fadeOut().end().delay(400).fadeOut('slow');

    $(document).ready(function () {

        var $result = $('#search_box-result');
        $('#search').on('keyup', function () {
            var search = $(this).val();
            if ((search != '') && (search.length > 3)) {
                $('.preloader').fadeIn();
                $.ajax({
                    type: "POST",
                    url: "/api/admin/search",
                    data: {'search': search},
                    success: function (msg) {

                        $result.html(msg);
                        console.log(msg);
                        let arr = [];
                        let verstka = ''
                        $.each(msg, function (key, value) {
                            arr[key] = '<tr>'
                            console.log(value)
                            $.each(value, function (key2, value2) {
                                if (key2 == "user") {
                                    arr[key] += `<tr class="tra"><td rowspan="${value2.code_counter}" id="name_${value2.belongs_user_id}">${value2.user_name} <br> ${value2.user_second_name} <br> ${value2.user_patronymic} <br> ${value2.user_phone} <br> ${value2.user_email} </td>`
                                } else {
                                    $.each(value2, function (key3, value3) {
                                        if (key3 < 1) {
                                            arr[key] += `
                                            <td>${value3.code_string}</td>
                                            <td><a href="${value3.ticket_path}">${value3.ticket_path}</a></td>
                                            <td>${value3.code_activated_time}</td>
                                            <td contenteditable="true" class="edit" id="input">
                                            <input type="checkbox" id="code_tea_win-${value3.code_id}" class="code_tea_win" ${value3.code_tea_win}></input>
                                            </td>
                                            <td contenteditable="true" class="edit" id="code_tea_win_discription-${value3.code_id}">${value3.code_tea_win_discription ? value3.code_tea_win_discription : ''}</td>
                                            <td contenteditable="true" class="edit" id="code_tea_win_date_delivery-${value3.code_id}">${value3.code_tea_win_date_delivery ? value3.code_tea_win_date_delivery : ''}</td>
                                            <td contenteditable="true" class="edit" id="input">
                                            <input type="checkbox" id="code_main_win-${value3.code_id}" class="code_main_win" ${value3.code_main_win}></input>
                                            </td>
                                            <td contenteditable="true" class="edit" id="code_main_win_discription-${value3.code_id}">${value3.code_main_win_discription ? value3.code_main_win_discription : ''}</td>
                                            <td contenteditable="true" class="edit" id="code_main_win_date_delivery-${value3.code_id}">${value3.code_main_win_date_delivery ? value3.code_main_win_date_delivery : ''}</td>
                                            </tr>`
                                        } else {
                                            arr[key] += `
                                            <tr>
                                            <td>${value3.code_string}</td>
                                            <td><a href="${value3.ticket_path}">${value3.ticket_path}</a></td>
                                            <td>${value3.code_activated_time}</td>
                                            <td contenteditable="true" class="edit" id="input">
                                            <input type="checkbox" id="code_tea_win-${value3.code_id}" class="code_tea_win" ${value3.code_tea_win}></input>
                                            </td>
                                            <td contenteditable="true" class="edit" id="code_tea_win_discription-${value3.code_id}">${value3.code_tea_win_discription ? value3.code_tea_win_discription : ''}</td>
                                            <td contenteditable="true" class="edit" id="code_tea_win_date_delivery-${value3.code_id}">${value3.code_tea_win_date_delivery ? value3.code_tea_win_date_delivery : ''}</td>
                                            <td contenteditable="true" class="edit" id="input">
                                            <input type="checkbox" id="code_main_win-${value3.code_id}" class="code_main_win" ${value3.code_main_win}></input>
                                            </td>
                                            <td contenteditable="true" class="edit" id="code_main_win_discription-${value3.code_id}">${value3.code_main_win_discription ? value3.code_main_win_discription : '' }</td>
                                            <td contenteditable="true" class="edit" id="code_main_win_date_delivery-${value3.code_id}">${value3.code_main_win_date_delivery ? value3.code_main_win_date_delivery : ''}</td>
                                            </tr>`
                                        }
                                    });
                                }
                            });
                            arr[key] += "</tr>"
                            console.log(arr[key])
                            verstka += arr[key];
                        });
                        const tableBody = document.querySelector("#for-parse");
                        tableBody.innerHTML = verstka;
                        $('.preloader').fadeOut();


                        if (msg != '') {
                            $result.fadeIn();
                        } else {
                            $result.fadeOut(100);
                        }
                        $('.edit').click(function () {
                            $(this).addClass('editMode');
                        });

                        // Save data
                        $(".edit").focusout(function () {
                            $(this).removeClass("editMode");
                            var id = this.id;
                            if(id == "input"){
                                value = $($(this).children().eq(0)).is(":checked");
                                id = $($(this).children().eq(0)).attr("id")
                                var split_id = id.split("-");
                                var field_name = split_id[0];
                                var edit_id = split_id[1];
                            }else {
                                var split_id = id.split("-");
                                var field_name = split_id[0];
                                var edit_id = split_id[1];
                                var value = $(this).text();
                            }
                            $.ajax({
                                type: 'POST',
                                url: '/api/admin/save',//файл с php скриптом, обновляющий данные в бд
                                data: {field: field_name, value: value, id: edit_id},// отправляем имя поля, новое значение и id, чтобы определить, что конкретно и как надо обновить в таблице
                                success: function (response) {
                                    console.log('Save successfully');
                                }
                            });

                        });
                    }
                });
            } else {
                $result.html('');
                $result.fadeOut(100);
            }
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search_box').length) {
                $result.html('');
                $result.fadeOut(100);
            }
        });

        $(document).on('click', '.search_result-name a', function () {
            $('#search').val($(this).text());
            $result.fadeOut(100);
            return false;
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.search_box').length) {
                $result.html('');
                $result.fadeOut(100);
            }
        });
    });
</script>
</html>
