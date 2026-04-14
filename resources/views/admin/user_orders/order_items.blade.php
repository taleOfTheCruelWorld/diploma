@extends('layout.admin.theme')
@section('content')
    <div class="container">
        <h1>Заказ №{{ $user_order->id }}</h1>


        <div class="item">
            <div class="id">ID: {{ $user_order->id }}</div>
            <div class="name">ФИО заказчика: {{ $user_order->fio}}</div>
            <div class="role">Адрес доставки: {{ $user_order->adress }}</div>
            <div class="role">Контактный телефон заказчика: {{ $user_order->phone }}</div>
            <div class="role">Финальная стоимость: {{ $user_order->total_cost }}</div>
            <h2 style="margin-top:30px;">Продукты заказа</h2>
            @foreach ($user_order->userOrderItems as $item)
                <a href="{{ route('product', ['product' => $item->product]) }}">{{ $item->product->name }}</a>
                <div class="role">Цена: {{ $item->price}} Руб.</div>
                <div class="role">Количество: {{ $item->count }}</div>
            @endforeach

        </div>


    </div>

@endsection