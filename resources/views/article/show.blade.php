@extends('layout.include')

@section('content')
    <div class="article-container">
        <div style="max-width: 820px">
            {{-- Заголовок и мета-данные --}}
            <div class="article-header">
                <h1>{{ $post->title }}</h1>
                <div class="article-date">
                    <span class="article-category">{{ $post->category->title ?? 'Новости' }} /</span>
                    {{ $post->created_at->locale('ru')->translatedFormat('d M') }}
                    <br>
                    <span>Автор статьи: Брызгалова П.Д.</span>
                </div>
            </div>

            {{-- Главное изображение --}}
            @if($post->image)
                <div class="article-image">
                    <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->title }}">
                </div>

            @endif

            {{-- ТЕЛО СТАТЬИ --}}
            <div class="article-body">
                {!! nl2br($post->content) !!}
            </div>
        </div>

        <div class="related-news">
            <div class="related-news-wrap">
                <h3 class="mb-4">Читайте также:</h3>
                <div class="related-grid">
                    @foreach($relatedNews as $item)
                        <div class="related-item">
                            <a href="{{ route('news.show', $item->id) }}">
                                @if($item->image)
                                    <img src="{{asset('storage/'.$item->image)}}" alt="">
                                @endif
                                <span>{{ $item->title }}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
