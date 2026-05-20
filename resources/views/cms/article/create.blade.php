<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создать новость</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body class="p-10">

<div class="max-w-4xl bg-white mx-auto p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Добавить новую статью</h1>

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

    <form action="{{ route('cms.article.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Заголовок -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 font-bold mb-2">Заголовок статьи</label>
            <input type="text" name="title" id="title" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500" value="{{ old('title') }}" placeholder="Введите заголовок...">
        </div>

        <!-- Фото обложки -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-bold mb-2">Обложка новости</label>
            <input type="file" name="image" id="image" class="w-full text-gray-700 border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label for="category" class="block text-gray-700 font-bold mb-2">Категория</label>
            <select name="category_id" id="category" class="w-full border rounded px-3 py-2 outline-none focus:border-blue-500">
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->title}}</option>
                @endforeach
            </select>
        </div>


        <!-- Редактор контента -->
        <div class="mb-6">
            <label for="content" class="block text-gray-700 font-bold mb-2">Текст статьи</label>
            <!-- Обрати внимание: ID редактора 'content-editor' -->
            <textarea name="content" id="content-editor">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
            Опубликовать
        </button>
    </form>
</div>

<!-- Инициализация CKEditor -->
<script>
    // Заменяем обычный textarea на CKEditor
    CKEDITOR.replace('content-editor', {
        height: 400, // Высота редактора
        removeButtons: 'PasteFromWord'
    });
</script>
</body>
</html>
