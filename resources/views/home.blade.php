@extends('layout.include')

@section('content')
    <div class="masonry-grid">
        @foreach($articles as $post)
            @include('layout.section.card', ['post' => $post])
        @endforeach
    </div>
@endsection
