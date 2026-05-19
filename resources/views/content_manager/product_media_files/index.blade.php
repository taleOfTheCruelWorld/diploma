@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Медиа-файлы продукта {{ $product->name }}</h1>
        <div class="search">
            <form action="{{ route('product-media-files.search', ['product' => $product]) }}" method="get"
                class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="ID" @if(isset($q)) value="{{ $q }}" @endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>

        <a href="{{ route('product-media-files.create', ['product' => $product]) }}">Создать медиа-файл</a>


        @foreach ($product_media_files as $file)
            <div class="item">
                <div class="data">

                </div>
                <div class="id">ID: {{ $file->id }}</div>
                <div class="name">Путь: {{ $file->path }}</div>
                <img src="{{ asset('storage/' . $file->path) }}" alt="img" style="width:100px;">
                <div class="actions">
                    <a
                        href="{{ route('product-media-files.edit', ['product' => $product, 'product_media_file' => $file]) }}">Изменить</a>
                    <a
                        href="{{ route('product-media-files.show', ['product' => $product, 'product_media_file' => $file]) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection