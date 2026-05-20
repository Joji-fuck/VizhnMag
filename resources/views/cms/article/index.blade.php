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
            <a href="{{route('cms.article.create')}}" class="btn btn-success">Создать новую запись</a>
        </div>
        <div class="news-bottom mt-4">
            <table class="table table-warning">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Превью</th>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Категория</th>
                    <th scope="col">Когда создана</th>
                    <th scope="col">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $article)
                <tr>
                        <th scope="row">{{$article->id}}</th>
                        <td><img src="{{asset('storage/' . $article->image)}}" style="width: 120px"/></td>
                        <td>{{$article->title}}</td>
                        <td>{{$article->category->title}}</td>
                        <td>{{$article->created_at}}</td>
                        <td>
                            <a href="{{ route('cms.article.edit', $article->id) }}" class="btn btn-warning btn-sm">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('cms.article.destroy', $article->id) }}" method="POST" style="display: inline;">
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
