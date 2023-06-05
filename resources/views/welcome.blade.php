<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Вітаємо на платформі</title>
</head>

<body>
<h1>Вітаємо на платформі Deutsch Vektor!</h1>
{{--висвічує помилки при авторизації--}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--вхід у систему--}}
<form action="{{route('login')}}" method="post">
    @csrf
    <input type="email" name="email" placeholder="E-mail">
    <input type="password" name="password" placeholder="Password">
    <button type="submit">Увійти</button>
</form>

<h3>Немає облікового запису?</h3>
<a href="{{route('reg')}}" class="button"> Зареєструйтеся.</a>

</body>
</html>
