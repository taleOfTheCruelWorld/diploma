@extends('layout.content_manager.theme')
@section('content')
    <div class="container">
        <h1>Продукты</h1>
          <div class="search">
            <form action="{{ route('products.search') }}" method="get" class="search_form">
                <div class="input_div">
                    <input type="text" name="q" placeholder="Имя или ID" @if(isset($q))value="{{ $q }}"@endif>
                </div>
                <input type="submit" value="Найти">
            </form>
        </div>
        <nav>
            <a href="{{ route('products.create') }}">Создать продукт</a>
        </nav>
      
            @foreach ($products as $product)
                <div class="item">
                    <div class="id">ID: {{ $product->id }}</div>
                    <div class="name">Название: {{ $product->name }}</div>
                    <a href="{{ route('products.show', ['product' => $product]) }}">Подробнее</a>
                </div>
            @endforeach
    </div>

@endsection