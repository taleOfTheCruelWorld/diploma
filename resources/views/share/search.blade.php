@extends('layout.share.theme')
@section('content')
    @if($products)
        <div class="meta">
            <h1>Найдено {{ count($products) }} товаров в категории {{ $category->name }}</h1>
            @include('share.parts.sort')
        </div>
        <div class="data">
            <div class="aside">
                @include('share.parts.filter')
            </div>
            <div class="main">
                @include('share.parts.products')
            </div>
        </div>
    @else
        <div class="meta">
            <h1>По вашему запросу ничего не найдено</h1>
        </div>
    @endif
    <script src="{{ asset('js/filter.js') }}"></script>
@endsection