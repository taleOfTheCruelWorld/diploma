@extends('layout.share.theme')

@section('content')

    <body>
        <div class="orders">
            @foreach ($orders as $order)
                <div class="order">
                    <div class="data">
                        <div class="number">Номер заказа: {{ $order->id }}</div>
                        <div class="created_at">Дата создания: {{ $order->created_at }}</div>
                        <div class="updated_at">Последнее обновление: {{ $order->updated_at }}</div>
                        <div class="status">Статус: {{ $order->userOrderStatus->name }}</div>
                        <div class="total_cost">Итоговая стоимость: {{ $order->total_cost }}</div>
                    </div>
                    <div class="products">
                        @foreach ($order->userOrderItems as $item)
                            <div class="product">
                                <div class="image">
                                    <img src="{{ asset('storage/' . $item->product->productMediafiles->first()->path) }}"
                                        alt="image">
                                </div>
                                <a href="{{ route('product', ['product' => $item->product]) }}">{{ $item->product->name }}</a>
                                <p>Цена: {{ $item->price }} Руб.</p>
                                <p>Количество: {{ $item->count }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="line"></div>
            @endforeach
            @forelse($orders as $order)
            @empty
                Упс! Кажется здесь ничего нет!
            @endforelse
        </div>
    </body>

@endsection