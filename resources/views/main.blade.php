<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна</title>
</head>
<body>
{{--дата і вітання--}}
<h2>{{$date}}</h2>
<h1>Вітаємо, {{$user->first_name}}!</h1>

<h2>Мої курси</h2>
{{--мої курси--}}
@if($courses->isEmpty())
    <p>Поки що немає...</p>
@else
@foreach($courses as $course)
{{--при натисканні переходимо до інформації по курсу--}}
    <form action="{{route('content', ['id' => $course->id])}}" method="POST">
        @csrf
        <button type="submit">{{$course->group_name}}</button>
    </form>
@endforeach
    @endif

{{--посилання на всі існуючі групи--}}
<a href="{{route('allgroups')}}">Всі групи</a>

<h2>Розклад на тиждень:</h2>
@if($courses->isEmpty())
    <p>Поки що немає...</p>
@else
@foreach($schedules as $schedule)
    <p>{{$schedule->group_name}} - {{$schedule->day}} {{$schedule->time}}</p>
@endforeach
@endif

<form action="{{route('logout')}}" method="POST">
    @csrf
    <button type="submit">Вийти</button>
</form>
</body>
</html>
