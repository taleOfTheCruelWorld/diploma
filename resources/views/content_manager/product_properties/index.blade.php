@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Свойства продукта {{ $product->name }}</h1>
        <nav>
            <a href="{{ route('product-properties.create', ['product' => $product]) }}">Создать свойство для этого
                продукта</a>
        </nav>
     
            @foreach ($product_properties as $property)
                <div class="item">
                    <div class="id">ID: {{ $property->id }}</div>
                    <div class="name">Название: {{ $property->categoryProductProperty->name }}</div>
                    <div class="value">Значение: {{ $property->value }}</div>
                    <a
                        href="{{ route('product-properties.show', ['product' => $product, 'product_property' => $property]) }}">Подробнее</a>
                </div>
            @endforeach
        
    </div>

@endsection