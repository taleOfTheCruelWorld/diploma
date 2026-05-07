@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Типы свойств продуктов</h1>
          <div class="search">
            <form action="{{ route('product-property-types.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q))value="{{ $q }}"@endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>
        <nav>
            <a href="{{ route('product-property-types.create') }}">Создать тип свойств продуктов</a>
        </nav>
        
            @foreach ($product_property_types as $type)
                <div class="item">
                    <div class="id">ID: {{ $type->id }}</div>
                    <div class="name">Название: {{ $type->name }}</div>
                    <a href="{{ route('product-property-types.show', ['product_property_type' => $type]) }}">Подробнее</a>
                </div>
            @endforeach
       
    </div>

@endsection