@extends('layout.share.theme')
@section('content')
    <form action="{{ route('loginHandler') }}" method="post" class="auth_form">
        @csrf
        <div class="meta">
            <div class="title">Авторизация</div>
            <a href="{{ route('registration') }}">Зарегистрироваться</a>
        </div>
        <div class="data">
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="email" placeholder="email" value="{{ old('email') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="password" name="password" placeholder="Пароль" value="{{ old('password') }}">
            </div>
            <input type="submit" value="Войти">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div>
    </form>
@endsection