@extends('layout.share.theme')
@section('content')
    <form action="{{ route('registrationHandler') }}" method="post" class="auth_form">
        @csrf
        <div class="meta">
            <div class="title">Регистрация</div>
            <a href="{{ route('login') }}">Войти</a>
        </div>
        <div class="data">
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="password" placeholder="Пароль" value="{{ old('password') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
            </div>
            <input type="submit" value="Зарегистрироваться">
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div>
    </form>
@endsection