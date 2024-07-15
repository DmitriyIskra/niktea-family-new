<!DOCTYPE html>
<html>
<head>
    <title>Niktea</title>
</head>
<body style="        background: #fafafa url(https://jackrugile.com/images/misc/noise-diagonal.png);
        color: #444;
        font: 100%/30px 'Helvetica Neue', helvetica, arial, sans-serif;
        text-shadow: 0 1px 0 #fff;">
<h1>Добрый день, данные по зарегистрированным пользователям, по датам</h1>
<h1>Текущее общее количество пользователей {{ $result["sum"] }}</h1>
<table style='        background: #f5f5f5;
        border-collapse: separate;
        box-shadow: inset 0 1px 0 #fff;
        font-size: 12px;
        line-height: 24px;
        margin: 30px auto;
        text-align: left;
        width: 800px;'>
    <tr>
        <th>Дата</th>
        <th>Количество зарег. пользователей</th>

    </tr>
@foreach ($result["data"] as $date => $user_count)

        <tr>
            <td
                style="border-right: 1px solid #fff;
        border-left: 1px solid #e8e8e8;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #e8e8e8;
        padding: 10px 15px;
        position: relative;
        transition: all 300ms;">
                {{ $date }}
            </td>
            <td
                style="border-right: 1px solid #fff;
        border-left: 1px solid #e8e8e8;
        border-top: 1px solid #fff;
        border-bottom: 1px solid #e8e8e8;
        padding: 10px 15px;
        position: relative;
        transition: all 300ms;">{{ $user_count }}</td>

@endforeach

</table >
</body>
</html>
