@extends('layout.crm')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="news">
        <div class="news-top">
            <a href="{{route('cms.index')}}" class="btn btn-primary">Домой</a>
            <a href="{{route('cms.movie.create')}}" class="btn btn-success">Создать новую запись</a>
        </div>
        <div class="news-bottom mt-4">
            <table class="table table-warning">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Превью</th>
                    <th scope="col">Название</th>
                    <th scope="col">Год выпуска</th>
                    <th scope="col">Описание</th>
                    <th scope="col">Жанр</th>
                    <th scope="col">Режиссер</th>
                    <th scope="col">Дата релиза</th>
                    <th scope="col">Длительность</th>
                    <th scope="col">Страна</th>
                    <th scope="col">Город</th>
                    <th scope="col">Ссылка</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                                @foreach($movies as $movie)
                                    <tr>
                                        <th scope="row">{{$movie->id}}</th>
                                        <td><img src="{{asset('storage/' . $movie->image)}}" style="width: 120px"/></td>
                                        <td>{{$movie->title}}</td>
                                        <td>{{$movie->year}}</td>
                                        <td>{{$movie->description}}</td>
                                        <td>{{$movie->genre}}</td>
                                        <td>{{$movie->director}}</td>
                                        <td>{{$movie->release_date}}</td>
                                        <td>{{$movie->duration}} минут</td>
                                        <td>{{$movie->country}}</td>
                                        <td>{{$movie->city}}</td>
                                        <td><a href="{{$movie->link}}">Ссылка</a></td>
                                        <td>
                                            <a href="{{ route('cms.movie.edit', $movie->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('cms.movie.destroy', $movie->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить статью?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
