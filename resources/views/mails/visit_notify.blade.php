<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Статистика посещений на {{ date('Y-m-d h:i:s') }}</title>
</head>
<body>
<h1>Привет, {{ $name }}!</h1>

<p>Последняя инфа по посещениям</p>
<p>Новых  посещений: {{ $content['new'] }}</p>
<p>Сегодня: {{ $content['today'] }}</p>
<p>Всего: {{ $content['all'] }}</p>

<p>Данное сообщение сформировано автоматически, пожалуйста не отвечайте на него!</p>
</body>
</html>