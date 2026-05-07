@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
    <h1>Свойства продуктов категории {{ $category->name }}</h1>
      <div class="search">
            <form action="{{ route('category-product-properties.search', ['category'=>$category]) }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q))value="{{ $q }}"@endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>
    <nav>
        <a href="{{ route('category-product-properties.create', ['category' => $category]) }}">Создать свойство для этой
            категории</a>
    </nav>

    @foreach ($category_product_properties as $property)
        <div class="item">
            <div class="id">ID: {{ $property->id }}</div>
            <div class="name">Название: {{ $property->name }}</div>
            <a
                href="{{ route('category-product-properties.show', ['category' => $category, 'category_product_property' => $property]) }}">Подробнее</a>
        </div>
    @endforeach
    </div>
@endsection