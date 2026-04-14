@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>ID: {{ $product_media_file->id }}</h1>
        <h1>Путь: {{ $product_media_file->path }}</h1>
        <img src="{{ asset('storage/' . $product_media_file->path) }}" alt="img" style="width:100px">
        <div class="actions">
            <form method="post"
                action="{{ route('product-media-files.destroy', ['product' => $product, 'product_media_file' => $product_media_file]) }}">
                <a
                    href="{{ route('product-media-files.edit', ['product' => $product, 'product_media_file' => $product_media_file]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection