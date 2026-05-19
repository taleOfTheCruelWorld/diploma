@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <a href="{{ route('category-product-properties.index', ['category' => $category]) }}">Назад</a>
        <div>ID: {{ $category_product_property->id }}</div>
        <div>Использовать в фильтре: {{ $category_product_property->used_in_filter }}</div>
        <div class="name">Характеристика: <a
                href="{{ route('properties.show', ['property' => $category_product_property->property]) }}">{{ $category_product_property->property->name }}</a>
        </div>
        <div class="actions">
            <form method="post"
                action="{{ route('category-product-properties.destroy', ['category' => $category, 'category_product_property' => $category_product_property]) }}">
                <a
                    href="{{ route('category-product-properties.edit', ['category' => $category, 'category_product_property' => $category_product_property]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection