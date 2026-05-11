@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <div class="id">ID: {{ $property->id }}</div>
        <div class="name">Название: {{ $property->name }}</div>
        <div class="name">Единица измерения: {{ $property->units }}</div>
        <div class="name">Тип: {{ $property->type }}</div>
        <div class="name">Группа характеристик: <a
                href="{{ route('product-property-groups.show', ['product_property_group' => $property->productPropertyGroup]) }}">{{ $property->productPropertyGroup->name }}</a>
        </div>
        <div class="actions">
            <form method="post" action="{{ route('properties.destroy', ['property' => $property]) }}">
                <a href="{{ route('properties.edit', ['property' => $property]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>

@endsection