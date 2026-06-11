@extends('layout.include')

@section('content')
    {{-- Общий контейнер фильма --}}
    <div class="movie-container">

        {{-- ЛЕВАЯ КОЛОНКА: Постер и кнопка --}}
        <div class="movie-img">
            @if($movie->poster)
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}">
            @else
                <img src="{{ asset('images/no-image.jpg') }}" alt="Нет постера">
            @endif

            {{-- Кнопка просмотра --}}
            <a href="{{ route('movie.watch', $movie->id) }}" class="btn-watch movie-button">
                Смотреть онлайн
            </a>
        </div>

        {{-- ПРАВАЯ КОЛОНКА: Описание и мета-данные --}}
        <div class="movie-meta">

            <div class="movie-header">
                <h1>{{ $movie->title }}</h1>
            </div>

            {{-- Главное изображение --}}
            @if($post->image)
                <div class="article-image">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                </div>
            @endif

            {{-- ТЕЛО СТАТЬИ --}}
            <div class="article-body">
                {!! nl2br($post->content) !!}
            </div>
        </div>

        <div class="related-news">
            <div class="related-news-wrap">
                <h3 class="mb-4">Читайте также:</h3>
                <div class="related-grid">
                    @foreach($relatedNews as $item)
                        <div class="related-item">
                            <a href="{{ route('news.show', $item->id) }}">
                                @if($item->image)
                                    <img src="{{asset('storage/'.$item->image)}}" alt="">
                                @endif
                                <span>{{ $item->title }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
