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
                <input type="password" name="password" placeholder="Пароль" value="{{ old('password') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}">
            </div>
            <div class="input_div">
                <div class="img"></div>
                <input type="text" name="phone" placeholder="Телефон" value="{{ old('phone') }}">
            </div>
            <input type="submit" value="Зарегистрироваться" class="submit">
            <div class="checkbox_div">
                <label for="">Я согласен с <a href="#">Политикой обработки персональных данных</a> <input type="checkbox"
                        name="policy_confirmation" id="policy_confirmation" class="checkbox"></label>

            </div>
            @foreach ($errors->all() as $error)
                <p style="color:red;">{{ $error }}</p>
            @endforeach
        </div>
    </form>
    <script src="{{ asset('js/policyConfirmation.js') }}"></script>
@endsection