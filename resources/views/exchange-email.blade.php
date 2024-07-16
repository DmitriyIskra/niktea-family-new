<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>Привет, Лиза!</h1>
    <br>
    <p>Вот все что тебе нужно о запросе на обмен подарков</p>
    <br>
    <p>ID пользователя: <br> {{ var_dump($data) }}</p>
    <p>Фамилия пользователя: <br> {{ $data['user_second_name'] }}</p>
    <p>Имя пользователя: <br> {{ '$data->user_name' }}</p>
    <p>Отчество пользователя: <br> {{ '$data->user_patronymic' }}</p>
    <p>Номер телефона пользователя: <br> {{ '$data->user_phone' }}</p>
    <p>Email адрес пользователя: <br> {{' $data->user_email' }}</p>
    <br>
    <p>Адрес: <br> {{ '$data->user_address' }}</p>
    <br>
    <p>Индекс подарка: {{ '$data->index' }} </p>
    <p>Наименование подарка: {{ '$data->name '}} </p>
    <p>Стоимость подарка в баллах: {{ '$data->points '}} </p>

    <h2>Хорошего и продуктивного дня!!!)))</h2>
</body>
</html>