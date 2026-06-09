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

            {{-- Характеристики фильма --}}
            <div class="movie-meta-section">
                <span><strong>Год:</strong> {{ $movie->year }}</span>
                <span><strong>Жанр:</strong> {{ $movie->genre }}</span>
                <span><strong>Режиссер:</strong> {{ $movie->director }}</span>
                <span><strong>Длительность:</strong> {{ $movie->duration }} мин.</span>
            </div>

            {{-- Описание --}}
            <div class="movie-description">
                {!! nl2br(e($movie->description)) !!}
            </div>

            {{-- Блок для трейлера или плеера (класс movie-rewind из твоего CSS) --}}
            @if($movie->trailer_url)
                <div class="movie-rewind" style="margin-top: 20px;">
                    <iframe width="100%" height="250" src="{{ $movie->trailer_url }}" frameborder="0" allowfullscreen style="border-radius: 15px;"></iframe>
                </div>
            @endif

        </div>

    </div>
@endsection
