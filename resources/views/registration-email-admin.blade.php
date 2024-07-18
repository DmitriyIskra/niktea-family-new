<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>Привет, Лиза! &#128075;</h1>
    <br>
    <p><span>&#127803;</span> У нас новый пользователь <span>&#127803;</span></p>
    <br>
    <p><span style="color: green;">&#10148;</span> ID пользователя: {{ $data['user_id'] }}</p>
    <p><span style="color: green;">&#10148;</span> Фамилия пользователя:  {{ $data['user_second_name'] }}</p>
    <p><span style="color: green;">&#10148;</span> Имя пользователя:  {{ $data['user_name'] }}</p>
    <p><span style="color: green;">&#10148;</span> Отчество пользователя:  {{ $data['user_patronymic'] }}</p>
    <p><span style="color: green;">&#10148;</span> Номер телефона пользователя:  {{ $data['user_phone'] }}</p>
    <p><span style="color: green;">&#10148;</span> Email адрес пользователя:  {{ $data['user_email'] }}</p>

    <h2>Хорошего и продуктивного дня!!!&#128512;</h2>
</body>
</html>