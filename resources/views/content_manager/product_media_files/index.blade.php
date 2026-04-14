@extends('layout.content_manager.theme')
@section('content')
<div class="container">
 <h1>Медиа-файлы продукта {{ $product->name }}</h1>
    <nav>
        <a href="{{ route('product-media-files.create', ['product'=>$product]) }}">Создать медиа-файл</a>
    </nav>
   
        @foreach ($product_media_files as $file)
            <div class="item">
                <div class="id">ID: {{ $file->id }}</div>
                <div class="name">Путь: {{ $file->path }}</div>
                <img src="{{ asset('storage/' . $file->path) }}" alt="img" style="width:100px;">
                <a href="{{ route('product-media-files.show', ['product'=>$product,'product_media_file' => $file]) }}">Подробнее</a>
            </div>
        @endforeach
    
</div>
   
@endsection