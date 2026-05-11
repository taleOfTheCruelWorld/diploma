@use('App\Models\Category')
@use('App\Models\Product')
@use('App\Models\ProductPropertyGroup')
@use('App\Models\Property')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_and_content_manager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin_and_content_manager_search_form.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
    @if(isset($css))
        @foreach ($css as $one)
            <link rel="stylesheet" href="{{ asset($one) }}">
        @endforeach
    @endif
</head>

<body>
    <header>
        <nav>
            <a href="{{ route('categories.index') }}">Категории продуктов ({{ Category::count() }})</a>
            <a href="{{ route('products.index') }}">Продукты ({{ Product::count() }})</a>
            <a href="{{ route('product-property-groups.index') }}">Группы характеристик продуктов
                ({{ ProductPropertyGroup::count() }})</a>
                  <a href="{{ route('properties.index') }}">Характеристики продуктов
                ({{ Property::count() }})</a>
        </nav>
    </header>
    <div class="content">
        @yield('content')
    </div>

</body>

</html>