@extends('layout.include')

@section('content')
    <div class="masonry-movie-grid">
        @foreach($movies as $movie)
            @include('layout.section.movieCard', ['post' => $movie])
        @endforeach
    </div>
@endsection
