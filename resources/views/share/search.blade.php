@extends('layout.share.theme')
@section('content')

    <body>

        <div class="content">
            @if($products)
                <div class="meta">
                    <h1>Найдено {{ count($products) }} товаров по вашему запросу</h1>
                </div>
                <div class="data">
                    <div class="main"> @include('share.parts.products')</div>
                </div>
            @else
                <div class="meta">
                    <h1>По вашему запросу ничего не найдено</h1>
                </div>
            @endif

        </div>
    </body>
@endsection