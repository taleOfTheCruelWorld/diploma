@extends('layout.share.theme')
@section('content')

            <div class="meta">
                <h1>Найдено {{ count($products) }} товаров</h1>
            </div>

            <div class="data">
                <div class="main"> @include('share.parts.products')</div>
            </div>

@endsection