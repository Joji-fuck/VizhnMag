@extends('layout.include')

@section('content')
    <div class="container d-flex gap-5">
        {{-- Главное изображение --}}
        <div class="movie-img">
            @if($post->image)
                <div class="movie-image">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                </div>
            @endif
            <a href="{{$post->link}}" class="btn btn-watch">Смотреть!</a>
        </div>
        <div>
            <div class="movie-header">
                <h1>{{$post->title . " (" . $post->year . ')'}}</h1>
                <span class="movie-description">{{$post -> description}}</span>
            </div>
            <div class="movie-meta mt-5">
                <h2>О фильме</h2>
                <div class="movie-meta-section">
                    <span>Возрастной рейтинг: </span> <span><i>12+</i></span>
                </div>
                <div class="movie-meta-section">
                    <span>Жанр: </span> <span><i>{{$post->genre}}</i></span>
                </div>
                <div class="movie-meta-section">
                    <span>Режиссер: </span> <span><i>{{$post->director}}</i></span>
                </div>
                <div class="movie-meta-section">
                    <span>Дата релиза: </span>
                    @php
                        $date = \Carbon\Carbon::parse($post->release_date);
                    @endphp
                    <span><i>{{$date->translatedFormat('j F Y')}}</i></span>
                </div>
                <div class="movie-meta-section">
                    <span>Длительность: </span> <span><i>{{$post->duration}} минут</i></span>
                </div>
                <div class="movie-meta-section">
                    <span>Страна: </span> <span><i>{{$post->country}}</i></span>
                </div>
            </div>
        </div>

        <div class="movie-rewind rounded-2xl bg-white shadow-md p-4 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-2xl font-bold flex items-center gap-2">
                    <span class="text-yellow-400">★</span>
                    {{ $post->average_rating }}
                    <span class="text-gray-400 text-lg font-normal">/ 10</span>
                </h3>
                <span class="bg-gray-100 text-gray-700 text-sm font-medium px-3 py-1 rounded-full">
            {{ $post->ratings_count }} оценок
        </span>
            </div>

            {{-- Успех --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Форма --}}
            <form action="{{ route('movies.rate', $post) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Ваш ник</label>
                    <input
                        type="text"
                        name="nickname"
                        value="{{ old('nickname') }}"
                        placeholder="Введите никнейм"
                        required
                        class="w-full px-4 py-2 border @error('nickname') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    >
                    @error('nickname') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Оценка</label>
                    <div class="flex gap-1 text-3xl select-none" id="rating-stars">
                        @for ($i = 1; $i <= 10; $i++)
                            <span
                                class="cursor-pointer text-gray-300 hover:scale-110 transition-transform"
                                data-value="{{ $i }}"
                            >★</span>
                        @endfor
                    </div>
                    <input type="hidden" name="score" id="score-input" value="{{ old('score') }}">
                    <p class="text-sm text-gray-500 mt-1">
                        Выбрано: <span id="score-display" class="font-semibold">{{ old('score', '—') }}</span> / 10
                    </p>
                    @error('score') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Отзыв <span class="text-gray-400 font-normal">(необязательно)</span>
                    </label>
                    <textarea
                        name="review"
                        rows="4"
                        maxlength="1000"
                        placeholder="Поделитесь впечатлениями о фильме..."
                        class="w-full px-4 py-2 border @error('review') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                    >{{ old('review') }}</textarea>
                    @error('review') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <button
                    type="submit"
                    class="movie-button bg-blue-600 mt-3 mb-3 hover:bg-blue-700 text-white font-semibold px-6 py-2 p-2 rounded-lg shadow transition"
                >
                    Оценить
                </button>
            </form>
            <div>
                <h4 class="text-xl font-bold mb-4">
                    Отзывы
                    <span class="text-gray-400 font-normal">({{ $post->ratings()->whereNotNull('review')->count() }})</span>
                </h4>
                @forelse ($post->ratings()->whereNotNull('review')->latest()->get() as $rating)
                    <div class="py-1 rounded-r-lg">
                        <div class="flex justify-between items-center mb-1">
                            <strong class="text-gray-800">{{ $rating->nickname }}</strong>
                            <span class="bg-yellow-400 text-gray-900 text-xs font-bold px-2 py-1 rounded-full">
                        ★ {{ $rating->score }}/10
                    </span>
                        </div>
                        <p class="text-gray-700 mb-1">{{ $rating->review }}</p>
                        <small class="text-gray-400 text-xs">{{ $rating->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-gray-500 text-center py-4">Пока никто не оставил отзыв. Будьте первым!</p>
                @endforelse
            </div>
        </div>

        {{-- Список отзывов --}}


        {{-- JS для интерактивных звёзд --}}
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const stars = document.querySelectorAll('#rating-stars span');
                const scoreInput = document.getElementById('score-input');
                const scoreDisplay = document.getElementById('score-display');

                const paint = (value) => {
                    stars.forEach(star => {
                        const v = parseInt(star.dataset.value);
                        star.classList.toggle('text-yellow-400', v <= value);
                        star.classList.toggle('text-gray-300', v > value);
                    });
                };

                if (scoreInput.value) paint(parseInt(scoreInput.value));

                stars.forEach(star => {
                    star.addEventListener('mouseenter', () => paint(parseInt(star.dataset.value)));
                    star.addEventListener('click', () => {
                        const v = parseInt(star.dataset.value);
                        scoreInput.value = v;
                        scoreDisplay.textContent = v;
                        paint(v);
                    });
                });

                document.getElementById('rating-stars').addEventListener('mouseleave', () => {
                    paint(parseInt(scoreInput.value) || 0);
                });
            });
        </script>
    </div>
@endsection
