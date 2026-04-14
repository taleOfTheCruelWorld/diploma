@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <div>ID: {{ $category_product_property->id }}</div>
        <div>Название: {{ $category_product_property->name }}</div>
        <h1>Тип свойства</h1>
        <div>ID: {{ $category_product_property->productPropertyType->id }}</div>
        <div>Название: {{ $category_product_property->productPropertyType->name }}</div>
        <div class="actions">
            <form method="post"
                action="{{ route('category-product-properties.destroy', ['category' => $category_product_property->category_id, 'category_product_property' => $category_product_property]) }}">
                <a
                    href="{{ route('category-product-properties.edit', ['category' => $category_product_property->category_id, 'category_product_property' => $category_product_property]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection