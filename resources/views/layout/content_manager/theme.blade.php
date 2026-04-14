@use('App\Models\Category')
@use('App\Models\Product')
@use('App\Models\CategoryProductProperty')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_and_content_manager.css') }}">
    @if(isset($css))
        @foreach ($css as $one)
            <link rel="stylesheet" href="{{ resource_path() . $one }}">
        @endforeach
    @endif
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('categories.index') }}">Категории продуктов ({{ Category::count() }})</a>
            <a href="{{ route('products.index') }}">Продукты ({{ Category::count() }})</a>
            <a href="{{ route('product-property-types.index') }}">Типы характеристик продуктов ({{ Category::count() }})</a>
        </nav>
    </header>
    @yield('content')
</body>

</html>