<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Інформація</title>
</head>
<body>

<h2>Інформація про групу:</h2>

@foreach ($group_info as $group)
    <p>Назва групи: {{ $group->group_name }}</p>
    <p>Куратор: {{ $group->initials }}</p>
    <p>Зв'язок<br> telegram: {{ $group->telegram }} | {{ $group->phone }}</p>
    <p>Рівень: {{ $group->name }}</p>
@endforeach


<h3>Всі учасники:</h3>

@php
    use Illuminate\Support\Facades\Auth;
        $loggedInUserFirstName = Auth::user()->first_name;
@endphp

@foreach($users as $user)
    @if($user->first_name == $loggedInUserFirstName)
        <p>{{ $user->first_name }} {{ $user->last_name }} (Я)</p>
    @else <p>{{ $user->first_name }} {{ $user->last_name }}</p> @endif
@endforeach


<h2>Розклад:</h2>
@foreach($schedules as $schedule)
<p>{{$schedule->day}} {{$schedule->time}}</p>
@endforeach


<h2>Інші курси</h2>
@foreach($others as $other)

    @if($group->group_name != $other->group_name)
        <form action="{{route('content', ['id' => $other->id])}}" method="POST">
            @csrf
            <button type="submit">{{$other->group_name}}</button>
        </form>
    @endif
@endforeach

<a href="{{route('main',['id'=>Auth::id()])}}">Назад</a>
</body>
</html>
