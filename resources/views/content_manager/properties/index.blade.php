@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Характеристики продуктов</h1>
        <div class="search">
            <form action="{{ route('properties.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q)) value="{{ $q }}" @endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>

        <a href="{{ route('properties.create') }}">Создать характеристику продуктов</a>

        @foreach ($properties as $property)
            <div class="item">
                <div class="data">
                    <div class="id">ID: {{ $property->id }}</div>
                    <div class="name">Название: {{ $property->name }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('properties.edit', ['property' => $property]) }}">Изменить</a>
                    <a href="{{ route('properties.show', ['property' => $property]) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection