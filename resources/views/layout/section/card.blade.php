<a href="{{route('news.show', $post->id)}}" class="news-card {{ !$post->image ? 'text-only' : '' }}">

    @if($post->image)
        <div class="card-image">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
        </div>
    @endif
    <div class="card-content">
        @if($post->category->title)
            <div class="card-meta">
                <span class="card-category">{{ $post->category->title }}</span>
                <span class="card-title">{{ $post->title }}</span>
            </div>
        @endif
    </div>
</a>
