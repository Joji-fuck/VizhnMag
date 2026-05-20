@extends('layout.crm')

@section('content')
        <a href="/cms" class="btn btn-danger">Назад</a>
        <h1 class="text-2xl font-bold mb-6">Добавить фильм</h1>

        <!-- Сообщения об успехе -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Ошибки -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cms.movie.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Название фильма</label>
                <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('title') }}" placeholder="Введите заголовок...">
            </div>
            <div class="mb-4">
                <label for="year" class="block text-gray-700 font-bold mb-2">Год/года</label>
                <input type="text" name="year" id="year" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('year') }}" placeholder="2024-2025">
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Описание</label>
                <input type="text" name="description" id="description" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('description') }}" placeholder="Пупка, залупка, хуюпка и шлюпка">
            </div>
            <div class="mb-4">
                <label for="image" class="block text-gray-700 font-bold mb-2">Постер фильма</label>
                <input type="file" name="image" id="image" class="w-full text-gray-700 border rounded px-3 py-2">
            </div>
            <div class="mb-4">
                <label for="genre" class="block text-gray-700 font-bold mb-2">Жанр</label>
                <input type="text" name="genre" id="genre" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('genre') }}" placeholder="Порно-фильм">
            </div>
            <div class="mb-4">
                <label for="director" class="block text-gray-700 font-bold mb-2">Режиссер</label>
                <input type="text" name="director" id="director" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('director') }}" placeholder="Пупка, залупка, хуюпка и шлюпка">
            </div>
            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-bold mb-2">Дата релиза</label>
                <input
                    class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500"
                    type="date"
                    name="release_date"
                    value="{{ old('release_date')}}"
                >
            </div>
            <div class="mb-4">
                <label for="duration" class="block text-gray-700 font-bold mb-2">Жанр (мин.)</label>
                <input type="text" name="duration" id="duration" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('duration') }}" placeholder="67">
            </div>
            <div class="mb-4">
                <label for="country" class="block text-gray-700 font-bold mb-2">Страна</label>
                <input type="text" name="country" id="country" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('country') }}" placeholder="Россия">
            </div>
            <div class="mb-4">
                <label for="city" class="block text-gray-700 font-bold mb-2">Город</label>
                <input type="text" name="city" id="city" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('city') }}" placeholder="Тюмень">
            </div>
            <div class="mb-4">
                <label for="link" class="block text-gray-700 font-bold mb-2">Ссылка</label>
                <input type="text" name="link" id="link" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('link') }}" placeholder="https://vk.com/zalupa">
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 p-5 rounded">
                Опубликовать
            </button>
        </form>
@endsection
