<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--показує усі достпні групи--}}
@foreach($group_infos as $course)
<div>
    <p>{{$course->group_name}}</p>
    <p>{{$course->type}}</p>
    <p>{{$course->level}}</p>
    <p>{{$course->initials}}</p>
    <form action="{{route('content', ['id' => $course->id])}}" method="POST">
        @csrf
        <button type="submit">Переглянути</button>
    </form>
    <p>---</p>
</div>

@endforeach

<a href="{{route('main',['id'=>Auth::id()])}}">Назад</a>

</body>
</html>
