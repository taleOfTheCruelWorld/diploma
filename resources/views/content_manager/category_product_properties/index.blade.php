@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
    <h1>Свойства продуктов категории {{ $category->name }}</h1>
    <nav>
        <a href="{{ route('category-product-properties.create', ['category' => $category]) }}">Создать свойство для этой
            категории</a>
    </nav>

    @foreach ($category_product_properties as $property)
        <div class="item">
            <div class="id">ID: {{ $property->id }}</div>
            <div class="name">Название: {{ $property->name }}</div>
            <a
                href="{{ route('category-product-properties.show', ['category' => $category, 'category_product_property' => $property]) }}">Подробнее</a>
        </div>
    @endforeach
    </div>
@endsection