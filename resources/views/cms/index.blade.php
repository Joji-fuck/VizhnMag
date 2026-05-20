@extends('layout.crm')

@section('content')
    <a href="{{route('home')}}" class="btn btn-danger">Назад</a>
    <h1>{{$user->name}}, я знаю чем мы займемся сегодня!</h1>
    <h6>Здесь три месяца длятся, каникулы летом...</h6>

    <div class="cms-cards">
        <a href="{{route('cms.article')}}" class="cms-card">
            <span>Новости</span>
        </a>
        <a href="{{route('cms.special')}}" class="cms-card">
            <span>Специальные выпуски</span>
        </a>
        <a href="{{route('cms.movie')}}" class="cms-card">
            <span>Смотри тюменское</span>
        </a>
    </div>
@endsection
