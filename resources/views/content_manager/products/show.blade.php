@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>ID: {{ $product->id }}</h1>
        <div>Название: {{ $product->name }}</div>
        <div>Цена: {{ $product->price }}</div>
        <div>Описание: {{ $product->description }}</div>
        <h1>Категория</h1>
        <div>ID: {{ $product->category->id }}</div>
        <div>Название: {{ $product->category->name }}</div>
        <div class="actions">
            <form method="post" action="{{ route('products.destroy', ['product' => $product]) }}">
                <a href="{{ route('products.edit', ['product' => $product]) }}">Изменить</a>
                <a href="{{ route('product-properties.index', ['product' => $product]) }}">Свойства этого продукта</a>
                <a href="{{ route('product-media-files.index', ['product' => $product]) }}">Медиа-файлы этого продукта</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection