@extends('layout.include')

@section('content')
    <div class="masonry-movie-grid">
        @foreach($posts as $post)
            @include('layout.section.movieCard', ['post' => $post])
        @endforeach
    </div>

@endsection
