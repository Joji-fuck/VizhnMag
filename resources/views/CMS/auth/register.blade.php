@extends('layout.crm')

@section('auth')
    <form class="auth" method="POST" action="{{route('register.auth')}}">
        @csrf
        <input type="text" name="surname" placeholder="Введите фамилию" value="{{old('surname')}}">
        <input type="text" name="name" placeholder="Введите имя" value="{{old('name')}}">
        <input type="text" name="login" placeholder="Введите логин" value="{{old('login')}}">
        <input type="password" name="password" placeholder="Введите пароль">
        <input type="password" name="password_confirmation" placeholder="Подтвердите пароль">
        <select name="role" id="role" class="form-select" required>
            <option value="" disabled selected>Кто вы?</option>
            <option value="Web-разработчик">Web-разработчик</option>
            <option value="Редактор">Редактор</option>
        </select>
        <button class="btn btn-success mt-3" type="submit">Войти</button>
        <a class="auth-next" href="{{route('login.index')}}">У меня есть аккаунт</a>
    </form>
@endsection
