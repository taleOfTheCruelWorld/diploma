@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>ID: {{ $product_property_type->id }}</h1>
        <h1>Название: {{ $product_property_type->name }}</h1>
        <div class="actions">
            <form method="post"
                action="{{ route('product-property-types.destroy', ['product_property_type' => $product_property_type]) }}">
                <a
                    href="{{ route('product-property-types.edit', ['product_property_type' => $product_property_type]) }}">Изменить</a>
                @csrf
                @method('DELETE')
                <button type="submit">Удалить</button>
            </form>
        </div>
    </div>
@endsection