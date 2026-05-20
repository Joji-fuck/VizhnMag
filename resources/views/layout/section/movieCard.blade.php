<a href="{{route('movie.show', $post->id)}}" class="movie-card {{ !$post->image ? 'text-only' : '' }}">
    <p class="card-movie-title">{{'"' . $post->title . '"'}}</p>
    <div class="movie-card-bg">
        @if($post->image)
            <div class="card-movie-image">
                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
            </div>
        @endif
    </div>
    <div class="card-movie-director">
        <p>{{$post->director}}</p>
    </div>
</a>
