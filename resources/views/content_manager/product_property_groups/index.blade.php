@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Группы свойств продуктов</h1>
        <div class="search">
            <form action="{{ route('product-property-groups.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q)) value="{{ $q }}" @endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>

        <a href="{{ route('product-property-groups.create') }}">Создать группу свойств продуктов</a>

        @foreach ($product_property_groups as $group)
            <div class="item">
                <div class="data">
                    <div class="id">ID: {{ $group->id }}</div>
                    <div class="name">Название: {{ $group->name }}</div>
                </div>
                <div class="actions">
                    <a href="{{ route('product-property-groups.edit', ['product_property_group' => $group]) }}">Изменить</a>
                    <a href="{{ route('product-property-groups.show', ['product_property_group' => $group]) }}">Подробнее</a>
                </div>
            </div>
        @endforeach
    </div>

@endsection