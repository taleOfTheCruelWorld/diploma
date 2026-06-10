@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Категории продуктов</h1>
        <div class="search">
            <form action="{{ route('categories.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q)) value="{{ $q }}" @endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>
        <a href="{{ route('categories.create') }}">Создать категорию продуктов</a>
        @foreach ($categories as $category)
            <div class="item">
                <div class="data">
                    <div class="id">ID: {{ $category->id }}</div>
                    <div class="name">Название: {{ $category->name }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('categories.edit', ['category' => $category]) }}">Изменить</a>
                    <a href="{{ route('category-product-properties.index', ['category' => $category]) }}">Характеристики продуктов
                        <a href="{{ route('categories.show', ['category' => $category]) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection