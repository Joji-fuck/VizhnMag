@extends('layout.include')

@section('content')
    <div class="masonry-movie-grid">
        {{-- КОЛОНКА 1 --}}
        <div class="masonry-movie-column">
            @foreach($col1 as $post)
                @include('layout.section.movieCard', ['post' => $post])
            @endforeach
        </div>

        {{-- КОЛОНКА 2 --}}
        <div class="masonry-movie-column">
            @foreach($col2 as $post)
                @include('layout.section.movieCard', ['post' => $post])
            @endforeach
        </div>

        {{-- КОЛОНКА 3 --}}
        <div class="masonry-movie-column">
            @foreach($col3 as $post)
                @include('layout.section.movieCard', ['post' => $post])
            @endforeach
        </div>

        {{-- КОЛОНКА 4 --}}
        <div class="masonry-movie-column">
            @foreach($col4 as $post)
                @include('layout.section.movieCard', ['post' => $post])
            @endforeach
        </div>
    </div>
@endsection
