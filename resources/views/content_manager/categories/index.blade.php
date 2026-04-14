@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Категории продуктов</h1>
        <nav>
            <a href="{{ route('categories.create') }}">Создать категорию продуктов</a>
        </nav>

        @foreach ($categories as $category)
            <div class="item">
                <div class="id">ID: {{ $category->id }}</div>
                <div class="name">Название: {{ $category->name }}</div>
                <a href="{{ route('categories.show', ['category' => $category]) }}">Подробнее</a>
            </div>
        @endforeach
    </div>
@endsection