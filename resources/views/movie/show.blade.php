@extends('layout.include')

@section('content')
    <div class="container movie-page">
        <div class="movie-layout">
            <div class="movie-img">
                @if($post->image)
                    <div class="movie-image">
                        <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                    </div>
                @endif

                <a href="{{ $post->link }}" class="btn-watch">Смотреть!</a>
            </div>
            <div class="movie-info">
                <div class="movie-header">
                    <h1 class="movie-title">{{ $post->title . " (" . $post->year . ')' }}</h1>
                    <p class="movie-description">{{ $post->description }}</p>
                </div>

                <div class="movie-meta">
                    <h2>О фильме</h2>

                    <div class="movie-meta-list">
                        <div class="movie-meta-section">
                            <span>Возрастной рейтинг:</span>
                            <span><i>12+</i></span>
                        </div>

                        <div class="movie-meta-section">
                            <span>Жанр:</span>
                            <span><i>{{ $post->genre }}</i></span>
                        </div>

                        <div class="movie-meta-section">
                            <span>Режиссер:</span>
                            <span><i>{{ $post->director }}</i></span>
                        </div>

                        <div class="movie-meta-section">
                            <span>Дата релиза:</span>
                            @php
                                $date = \Carbon\Carbon::parse($post->release_date);
                            @endphp
                            <span><i>{{ $date->translatedFormat('j F Y') }}</i></span>
                        </div>

                        <div class="movie-meta-section">
                            <span>Длительность:</span>
                            <span><i>{{ $post->duration }} минут</i></span>
                        </div>

                        <div class="movie-meta-section">
                            <span>Страна:</span>
                            <span><i>{{ $post->country }}</i></span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Правая колонка: рейтинг + отзывы --}}
            <div class="movie-rewind">
                <div class="movie-rating-top">
                    <h3 class="movie-rating-value">
                        <span class="movie-rating-icon">★</span>
                        {{ $post->average_rating }}
                        <span class="movie-rating-from">/ 10</span>
                    </h3>

                    <span class="movie-rating-count">
                        {{ $post->ratings_count }} оценок
                    </span>
                </div>

                {{-- Успех --}}
                @if (session('success'))
                    <div class="movie-alert movie-alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Форма --}}
                <form action="{{ route('movies.rate', $post) }}" method="POST" class="movie-form">
                    @csrf

                    <div class="movie-form-group">
                        <label class="movie-label">Ваш ник</label>
                        <input
                            type="text"
                            name="nickname"
                            value="{{ old('nickname') }}"
                            placeholder="Введите никнейм"
                            required
                            class="movie-input @error('nickname') is-error @enderror"
                        >
                        @error('nickname')
                        <p class="movie-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="movie-form-group">
                        <label class="movie-label">Оценка</label>

                        <div class="movie-stars" id="rating-stars">
                            @for ($i = 1; $i <= 10; $i++)
                                <span class="movie-star" data-value="{{ $i }}">★</span>
                            @endfor
                        </div>

                        <input type="hidden" name="score" id="score-input" value="{{ old('score') }}">

                        <p class="movie-score-text">
                            Выбрано:
                            <span id="score-display">{{ old('score', '—') }}</span> / 10
                        </p>

                        @error('score')
                        <p class="movie-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="movie-form-group">
                        <label class="movie-label">
                            Отзыв <span class="movie-label-muted">(необязательно)</span>
                        </label>

                        <textarea
                            name="review"
                            rows="4"
                            maxlength="1000"
                            placeholder="Поделитесь впечатлениями о фильме..."
                            class="movie-textarea @error('review') is-error @enderror"
                        >{{ old('review') }}</textarea>

                        @error('review')
                        <p class="movie-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="movie-button">
                        Оценить
                    </button>
                </form>

                {{-- Отзывы --}}
                <div class="movie-reviews">
                    <h4 class="movie-reviews-title">
                        Отзывы
                        <span>({{ $post->ratings()->whereNotNull('review')->count() }})</span>
                    </h4>

                    @forelse ($post->ratings()->whereNotNull('review')->latest()->get() as $rating)
                        <div class="movie-review-item">
                            <div class="movie-review-head">
                                <strong class="movie-review-name">{{ $rating->nickname }}</strong>
                                <span class="movie-review-score">★ {{ $rating->score }}/10</span>
                            </div>

                            <p class="movie-review-text">{{ $rating->review }}</p>
                            <small class="movie-review-time">{{ $rating->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <p class="movie-empty">Пока никто не оставил отзыв. Будьте первым!</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- JS для интерактивных звёзд --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const stars = document.querySelectorAll('#rating-stars .movie-star');
                const scoreInput = document.getElementById('score-input');
                const scoreDisplay = document.getElementById('score-display');
                const starsWrap = document.getElementById('rating-stars');

                const paint = (value) => {
                    stars.forEach(star => {
                        const v = parseInt(star.dataset.value);
                        star.classList.toggle('is-active', v <= value);
                    });
                };

                if (scoreInput.value) {
                    const currentValue = parseInt(scoreInput.value);
                    scoreDisplay.textContent = currentValue;
                    paint(currentValue);
                }

                stars.forEach(star => {
                    star.addEventListener('mouseenter', () => {
                        paint(parseInt(star.dataset.value));
                    });

                    star.addEventListener('click', () => {
                        const v = parseInt(star.dataset.value);
                        scoreInput.value = v;
                        scoreDisplay.textContent = v;
                        paint(v);
                    });
                });

                starsWrap.addEventListener('mouseleave', () => {
                    paint(parseInt(scoreInput.value) || 0);
                });
            });
        </script>
    </div>
@endsection
