@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Свойства продукта {{ $product->name }}</h1>
          <div class="search">
            <form action="{{ route('product-properties.search', ['product'=>$product]) }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="ID" @if(isset($q))value="{{ $q }}"@endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>
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