@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Продукты</h1>
        <div class="search">
            <form action="{{ route('products.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q)) value="{{ $q }}" @endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>

        <a href="{{ route('products.create') }}">Создать продукт</a>

        @foreach ($products as $product)
            <div class="item">
                <div class="data">
                    <div class="id">ID: {{ $product->id }}</div>
                    <div class="name">Название: {{ $product->name }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('products.edit', ['product' => $product]) }}">Изменить</a>
                    <a href="{{ route('product-properties.index', ['product' => $product]) }}">Свойства этого продукта</a>
                    <a href="{{ route('product-media-files.index', ['product' => $product]) }}">Медиа-файлы этого продукта</a>
                    <a href="{{ route('products.show', ['product' => $product]) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection