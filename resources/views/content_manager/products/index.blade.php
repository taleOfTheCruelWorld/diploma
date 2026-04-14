@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Продукты</h1>
        <nav>
            <a href="{{ route('products.create') }}">Создать продукт</a>
        </nav>
      
            @foreach ($products as $product)
                <div class="item">
                    <div class="id">ID: {{ $product->id }}</div>
                    <div class="name">Название: {{ $product->name }}</div>
                    <a href="{{ route('products.show', ['product' => $product]) }}">Подробнее</a>
                </div>
            @endforeach
    </div>

@endsection