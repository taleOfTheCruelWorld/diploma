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
        <nav>
            <a href="{{ route('index') }}">
                <img src="logo.png" alt="logo">
            </a>
            <a href="{{ route('index') }}">Главная</a>
            <a href="{{ route('catalog') }}">Каталог</a>
            <form action="{{ route('search') }}" method="get">
                <label for="">Искать</label>
                <input type="text" name="q" @if(isset($search)) value="{{ $search }}" @endif>
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
        <div class="category_list" style="display:flex;gap:10px;flex-flow: column nowrap;">
            <div class="scroll" style="display:flex; justify-content:space-between;padding:0px 20px">
                <button type="button" id="scroll_category_down" style="">left</button>
                <button type="button" id="scroll_category_up" style="">right</button>
            </div>
            <div class="categories" style="display:flex; flex:row nowrap; overflow:scroll;gap:20px;" id="categories">
                @foreach (Category::all() as $category)
                    <a href="{{ route('category', ['category' => $category]) }}">{{ $category->name }}</a>
                @endforeach
            </div>
        </div>
    </header>

    @yield('content')

    <footer>

    </footer>

    <script src="{{ asset('js/category_list_slider.js') }}"></script>

</body>

</html>