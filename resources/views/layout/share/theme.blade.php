@use('App\Models\Category')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/theme.css') }}">
    @if(isset($css))
        @foreach ($css as $one)
            <link rel="stylesheet" href="{{ asset($one) }}">
        @endforeach
    @endif
</head>

<body>

    <header>
        <div class="nav-mobile">
            Меню
        </div>
        <nav class="main_nav">
            <a href="{{ route('index') }}">
                <img src="{{ asset('logo.svg') }}" alt="logo" class="logo">
            </a>
            <a href="{{ route('index') }}">Главная</a>
            <a href="{{ route('catalog') }}">Каталог</a>
            <form action="{{ route('search') }}" method="get" id="search">
                <label for="">Искать</label>
                <input type="text" name="q" @if(isset($q)) value="{{ $q }}" @endif>
            </form>
            @auth
                <a href="{{ route('user.favorite') }}">Избранное</a>
                <a href="{{ route('user.cart') }}">Корзина</a>
                <a href="{{ route('user.orders') }}">История заказов</a>
                <a href="{{ route('logout') }}">Выйти</a>
            @endauth
            @guest
                <a href="{{ route('login') }}">Войти</a>
            @endguest
        </nav>
        <div class="category_list">
            <div class="scroll">
                <button type="button" id="scroll_category_down">&lt</button>
                <button type="button" id="scroll_category_up">&gt</button>
            </div>
            <div class="categories" id="categories">
                @foreach (Category::all() as $category)
                    <a href="{{ route('category', ['category' => $category]) }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer>
        <div class="column">
            <div class="title">Компания</div>
            <div class="data">
                <a href="#">О компании</a>
                <a href="#">Новости</a>
                <a href="#">Партнерам</a>
                <a href="#">Политика в отношении обработки конфиденциальных данных</a>
                <a href="#">Правила продаж</a>
                <a href="#">Правила пользования сайта</a>
            </div>
        </div>
        <div class="column">
            <div class="title">Покупателям</div>
            <div class="data">
                <a href="#">Как оформить заказ</a>
                <a href="#">Способы оплаты</a>
                <a href="#">Доставка</a>
                <a href="#">Статус заказа</a>
                <a href="#">Обмен, возврат</a>
                <a href="#">Юридическим лицам</a>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/category_list_slider.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>

</body>

</html>