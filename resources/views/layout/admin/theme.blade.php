@use('App\Models\User')
@use('App\Models\UserOrderStatus')
@use('App\Models\UserOrder')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_and_content_manager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_and_content_manager_search_form.css') }}">
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
            <a href="{{ route('user-order-statuses.index') }}">Статусы заказов пользователей
                ({{ UserOrderStatus::count() }})</a>
            <a href="{{ route('admin.user-orders.index') }}">Заказы пользователей ({{ UserOrder::count() }})</a>
            <a href="{{ route('admin.users.index') }}">Пользователи ({{ User::count() }})</a>
        </nav>
    </header>
    <div class="content">
        @yield('content')
    </div>
    <script src="{{ asset('js/menu.js') }}"></script>
</body>

</html>