@extends('layout.include')

@section('content')
    <div class="masonry-wrapper" id="masonry-wrapper">

    </div>

    <div id="masonry-source" style="display: none;">
        @foreach($articles as $post)
            @include('layout.section.card', ['post' => $post])
        @endforeach
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const source = document.getElementById('masonry-source');
            const wrapper = document.getElementById('masonry-wrapper');
            const cards = Array.from(source.children);
            function renderMasonry() {
                wrapper.innerHTML = '';
                let columnsCount = 1;
                if (window.innerWidth > 600) columnsCount = 2;
                if (window.innerWidth > 1100) columnsCount = 3;
                let columns = [];
                for (let i = 0; i < columnsCount; i++) {
                    let col = document.createElement('div');
                    col.className = 'masonry-col';
                    columns.push(col);
                    wrapper.appendChild(col);
                }
                cards.forEach((card, index) => {
                    let cardClone = card.cloneNode(true);
                    let columnIndex = index % columnsCount;
                    columns[columnIndex].appendChild(cardClone);
                });
            }
            renderMasonry();
            window.addEventListener('resize', renderMasonry);
        });
    </script>
@endsection
