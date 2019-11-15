@extends('layouts.site')
@section('content')
    <h1>Арабские Буквы</h1>
    <ul class="nav flex-column">
        @foreach($list as $item)
            <li class="nav-item"><a href="/grammatika/{{$item->getId()}}" class="nav-link active">{{$item->getName()}}</a></li>
        @endforeach
    </ul>
@endsection
