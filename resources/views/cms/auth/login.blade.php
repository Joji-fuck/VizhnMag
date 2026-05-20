@extends('layout.crm')

@section('auth')
    <form class="auth" method="POST" action="{{route('login.auth')}}">
        @csrf
        <input type="text" name="login" placeholder="Введите логин" value="{{old('login')}}">
        <input type="password" name="password" placeholder="Введите пароль">
        <button class="btn btn-success mt-3" type="submit">Войти</button>
        <a class="auth-next" href="{{route('register.index')}}">У меня нет аккаунта</a>
    </form>
@endsection
