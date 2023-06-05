<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Реєстрація</title>
</head>
<body>
<h1>Реєстрація</h1>
{{--висвічує помилки при неправильному введені даних--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--форма реєстрації--}}
<form action="/register" method="post">
    @csrf

    <input type="text" name="first_name" placeholder="Ім'я">
    <input type="text" name="last_name" placeholder="Прізвище">
    <input type="email" name="email" placeholder="E-mail">
    <input type="password" name="password" placeholder="Пароль">
    <input type="text" name="telegram" placeholder="telegram для зв'язку">
    <input type="text" name="phone" placeholder="Номер +380...">
    <button type="submit">Зареєструватися</button>
</form>
<a href="{{route('welcome')}}"> Повернутися назад.</a>

</body>
</html>
