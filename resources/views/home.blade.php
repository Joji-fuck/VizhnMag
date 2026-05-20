@extends('layout.include')

@section('content')
    <div class="masonry-grid">

        {{-- КОЛОНКА 1 --}}
        <div class="masonry-column">
            @foreach($col1 as $post)
                @include('layout.section.card', ['post' => $post])
            @endforeach
        </div>

        {{-- КОЛОНКА 2 --}}
        <div class="masonry-column">
            @foreach($col2 as $post)
                @include('layout.section.card', ['post' => $post])
            @endforeach
        </div>

        {{-- КОЛОНКА 3 --}}
        <div class="masonry-column">
            @foreach($col3 as $post)
                @include('layout.section.card', ['post' => $post])
            @endforeach
        </div>

    </div>
@endsection
