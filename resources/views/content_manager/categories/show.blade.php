@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>ID: {{ $category->id }}</h1>
        <div>Название: {{ $category->name }}</div>
        <div>Описание: {{ $category->description }}</div>
        @if($category->category)
            <h1>Родительская категория</h1>
            <div>ID: {{ $category->category->id }} </div>
            <div>Название: {{ $category->category->name}}</div>
        @endif
        <div class="actions">
            <form method="post" action="{{ route('categories.destroy', ['category' => $category]) }}">
                <a href="{{ route('categories.edit', ['category' => $category]) }}">Изменить</a>
                <a href="{{ route('category-product-properties.index', ['category' => $category]) }}">Свойства продуктов этой
                    категории</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection