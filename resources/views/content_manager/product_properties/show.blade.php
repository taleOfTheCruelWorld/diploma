@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Свойство продукта</h1>
        <div class="id">ID: {{ $product_property->id }}</div>
        <div class="name">Название: {{ $product_property->categoryProductProperty->name }}</div>
        <div class="value">Значение: {{ $product_property->value }}</div>
        <h1>Свойство категории</h1>
        <div>ID: {{ $product_property->categoryProductProperty->id }}</div>
        <div>Название: {{ $product_property->categoryProductProperty->name }}</div>
        <div>Описание: {{ $product_property->categoryProductProperty->description }}</div>
        <div class="actions">
            <form method="post"
                action="{{ route('product-properties.destroy', ['product' => $product, 'product_property' => $product_property]) }}">
                <a
                    href="{{ route('product-properties.edit', ['product' => $product, 'product_property' => $product_property]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection