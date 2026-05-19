@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
         <a href="{{ route('product-property-groups.index') }}">Назад</a>
        <h1>ID: {{ $product_property_group->id }}</h1>
        <h1>Название: {{ $product_property_group->name }}</h1>
        <div class="actions">
            <form method="post"
                action="{{ route('product-property-groups.destroy', ['product_property_group' => $product_property_group]) }}">
                <a
                    href="{{ route('product-property-groups.edit', ['product_property_group' => $product_property_group]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>
@endsection